<?php

namespace Modules\Product\Entities;

use App\Filters\ProductFilter;
use App\Traits\ImageTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Modules\Category\Entities\Category;
use Modules\Type\Entities\Type;

class Product extends Model
{
    use HasFactory, ImageTrait, Sluggable;

    protected $fillable = [
        'id', 'name',
        'description', 'price',
        'category_id',  'slug',
        'image', 'discount',
        'quantity', 'minimum',
        'maximum', 'is_best_sell_1',
        'is_best_sell_2', 'is_best_sell_3',
        'description1', 'maximum1',
        'price1', 'discount1',
        'description2', 'maximum2',
        'price2', 'discount2',
        'convert1', 'convert2', 'convert3',
        'types'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * return parent category
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getImagePathAttribute()
    {
        if (Storage::disk('public')->exists('products/' . $this->image)) {
            return $this->get_image($this->image,  'products');
        } else {
            return 'https://placehold.co/600x400';
        }
    }

    public function getPrice()
    {
        if (request()->get('type') == 1) {
            $price = $this->price;
            $discount = $this->discount;
        } else if (request()->get('type') == 2) {
            $price = $this->price1;
            $discount = $this->discount1;
        } else {
            $price = $this->price2;
            $discount = $this->discount2;
        }

        if ($discount || $discount != 0) {
            return $price - ($price * $discount / 100);
        }
        return $price;
    }

    public function price_before_discount()
    {
        if (request()->get('type') == 1) {
            $price = $this->price;
            $discount = $this->discount;
        } else if (request()->get('type') == 2) {
            $price = $this->price1;
            $discount = $this->discount1;
        } else {
            $price = $this->price2;
            $discount = $this->discount2;
        }

        return ($discount || $discount != 0) ? $price : null;
    }


    public function getMaximum()
    {
        if (request()->get('type') == 1) {
            $maximum = $this->maximum;
        } else if (request()->get('type') == 2) {
            $maximum = $this->maximum1;
        } else {
            $maximum = $this->maximum2;
        }

        return $maximum;
    }

    public function getDiscount()
    {
        if (request()->get('type') == 1) {
            $discount = $this->discount;
        } else if (request()->get('type') == 2) {
            $discount = $this->discount1;
        } else {
            $discount = $this->discount2;
        }

        return $discount;
    }

    public function getDescription()
    {
        if (request()->get('type') == 1) {
            $description = $this->description;
        } else if (request()->get('type') == 2) {
            $description = $this->description1;
        } else {
            $description = $this->description2;
        }

        return $description;
    }

    public function scopeFilter($query, ProductFilter $filter)
    {
        return $filter->apply($query);
    }

    public function isInCart()
    {
        $cartItems = CartItem::where('user_id', sanctum()->id())->where('product_id', $this->id)->count();

        if ($cartItems > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function quantityInCart()
    {
        $cartItem = CartItem::where('user_id', sanctum()->id())->where('product_id', $this->id)->first();

        if ($cartItem) {
            return $cartItem->quantity;
        } else {
            return 0;
        }
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function delete()
    {
        CartItem::where('product_id', $this->id)->delete();

        return parent::delete();
    }
}

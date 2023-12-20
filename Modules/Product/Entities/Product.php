<?php

namespace Modules\Product\Entities;

use App\Filters\ProductFilter;
use App\Traits\ImageTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory , ImageTrait , Sluggable;

    protected $fillable = [
        'id' , 'name' , 'description' , 'price' ,
        'category_id' , 'type_id' , 'slug' , 'image' ,
        'special_price' , 'discount' , 'quantity' , 
        'minimum' , 'maximum'
    ];

    protected $hidden = ['created_at' , 'updated_at'];
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

    public function getImagePathAttribute()
    {
        if (Storage::disk('public')->exists('products/'.$this->image)) {
            return $this->get_image($this->image,  'products');
        }else{
            return 'https://placehold.co/600x400';
        }
    }

    public function getPrice()
    {
        if ($this->discount || $this->discount != 0) {
            return $this->price - ($this->price * $this->discount / 100);
        }
        return $this->price;
    }

    public function price_before_discount()
    {
        return ($this->discount || $this->discount != 0) ? $this->price : null;
    }

    public function scopeFilter($query,ProductFilter $filter)
    {
        return $filter->apply($query);
    }

    public function isInCart()
    {
        $cartItems = CartItem::where('user_id' , sanctum()->id())->where('product_id' , $this->id)->count();

        if ($cartItems > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function quantityInCart()
    {
        $cartItem = CartItem::where('user_id' , sanctum()->id())->where('product_id' , $this->id)->first();
        
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
}

<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'guest_identifier',
        'product_id',
        'quantity'
    ];

    /**
     * return product in the cart
     *
     * @return BelongsTo
     */
    public function getProduct(): BelongsTo
    {
        return $this->belongsTo(Product::class , 'product_id');
    }

    /**
     * count subtotal (without the delivery cost) of cart items
     *
     * @return void
     */
    public function getSubtotalAttribute()
    {
        $product = $this->getProduct()->first();

        $subtotal = 0;

        // if ($product->discount) {
        //     $subtotal = $subtotal + ($this->quantity * ($product->price - ($product->price * $product->discount / 100)));
        // }else{
            $subtotal = $subtotal + ($this->quantity * $product->price);
        // }
    
        return $subtotal;
    }

    /**
     * return user who created the cart item
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

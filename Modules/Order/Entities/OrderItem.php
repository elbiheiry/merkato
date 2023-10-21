<?php

namespace Modules\Order\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Product\Entities\Product;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['id' , 'order_id' , 'product_id' , 'quantity' , 'price'];
    
    // protected static function newFactory()
    // {
    //     return \Modules\Order\Database\factories\OrderItemFactory::new();
    // }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}

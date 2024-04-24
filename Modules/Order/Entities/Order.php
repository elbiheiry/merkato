<?php

namespace Modules\Order\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Auth\Entities\User;
use Modules\User\Entities\Address;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'address_id', 'user_id', 'total', 'coupon_discount', 'coupon_code', 'status', 'payment_status', 'notes'];

    // protected static function newFactory()
    // {
    //     return \Modules\Order\Database\factories\OrderFactory::new();
    // }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getStatus()
    {
        switch ($this->status) {
            case 'preparing':
                return 'قيد التجهيز';
                break;

            case 'delivered':
                return 'تم التسليم';
                break;

            default:
                # code...
                break;
        }
    }
}

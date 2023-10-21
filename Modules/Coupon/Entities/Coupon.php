<?php

namespace Modules\Coupon\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'usage_count', 'max_usage', 'valid_till', 'discount'
    ];
    
    // protected static function newFactory()
    // {
    //     return \Modules\Coupon\Database\factories\CouponFactory::new();
    // }

    protected $dates = [
        'valid_till',
    ];

    public static function generateCoupon($code, $maxUsage, $validTill , $discount)
    {
        return self::create([
            'code' => $code,
            'max_usage' => $maxUsage,
            'valid_till' => $validTill,
            'discount' => $discount
        ]);
    }
}

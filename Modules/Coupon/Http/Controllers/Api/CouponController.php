<?php

namespace Modules\Coupon\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;
use Modules\Coupon\Entities\Coupon;
use Modules\Product\Entities\CartItem;

class CouponController extends Controller
{
    public function applyCoupon(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'coupon_code' => ['required' , 'string' , 'exists:coupons,code']
        ] , [
            
        ] ,[
            'coupon_code' => 'كود الخصم'
        ]);

        if ($validator->fails()) {
            return api_response_error($validator->errors()->first());
        }

        $couponCode = $request->coupon_code;
        $coupon = Coupon::where('code', $couponCode)->first();

        // Check if the coupon has reached its maximum usage limit
        if ($coupon->max_usage !== null && $coupon->usage_count >= $coupon->max_usage) {
            return api_response_error('لقد بلغت الحد الاقصي لاستخدام هذا الكوبون');
        }

        // Check if the coupon has expired
        if ($coupon->valid_till !== null && $coupon->valid_till->lt(Date::now())) {
            return api_response_error('لقد انتهت صلاحية هذا الكوبون');
        }

        $user = sanctum()->user();
        $cartItems = $user->cartItems;

        if (sizeof($cartItems) > 0) {
            $couponCode = $cartItems->first()->coupon;

            if ($couponCode) {
                return api_response_error('يتم استخدام هذا الكوبون بالفعل');
            }
        }

        foreach ($cartItems as $key => $value) {
            $value->coupon = $coupon->code;
            $value->save();
        }

        // Increase the coupon usage count
        $coupon->increment('usage_count');

        return api_response_success('تم اضافة الكوبون بنجاح');
    }

    public function removeCoupon(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'coupon_code' => ['required' , 'string' , 'exists:coupons,code']
        ] , [] ,[
            'coupon_code' => 'كود الخصم'
        ]);

        if ($validator->fails()) {
            return api_response_error($validator->errors()->first());
        }

        $user = sanctum()->user();
        $cartItems = $user->cartItems;

        try {
            foreach ($cartItems as $item) {
                $item->update([
                    'coupon' => null
                ]);
            }
    
            Coupon::where('code' , $request['coupon_code'])->decrement('usage_count');

            return api_response_success('تمإلغاء استخدام هذا الكوبون');
        } catch (\Throwable $th) {
            return api_response_error();
        }
        
    }
}

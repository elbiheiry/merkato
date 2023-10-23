<?php

namespace Modules\Product\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Product\Entities\CartItem;
use Modules\Product\Transformers\CartResource;
use Illuminate\Support\Str;
use Modules\Coupon\Entities\Coupon;

class CartController extends Controller
{

    public function index(Request $request)
    {
        $user = sanctum()->user();
        $cartItems = $user->cartItems;

        $subtotal = $cartItems->sum(function ($cartItem) {
            return $cartItem->subtotal;
        });

        $discount = 0;
        $couponCode = null;

        if (sizeof($cartItems) > 0) {
            $couponCode = $cartItems->first()->coupon;
            $coupon = Coupon::where('code', $couponCode)->first();

            if ($coupon) {
                $discount = $subtotal * $coupon->discount/100; 
            }
        }

        $total = $subtotal - $discount;

        return api_response_success([
            'cart_items' => CartResource::collection($cartItems)->response()->getData(true),
            'subtotal' => (double) $subtotal,
            'discount' => (double) $discount,
            'total' => (double) $total,
            // 'couponeCode' => $couponCode
        ]);
    }

    public function addItem(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'product_id' => ['required' , 'exists:products,id'],
            'quantity' => ['required' , 'numeric']
        ] , [] ,[
            'product_id' => locale() == 'en' ? 'Product' : 'المنتج',
            'quantity' => locale() == 'en' ? 'Quantity' : 'الكمية'
        ]);

        if ($validator->fails()) {
            return api_response_error($validator->errors()->first());
        }
        
        $user = sanctum()->user();
        $data['user_id'] = $user->id;
        $cartItem = CartItem::where('user_id', $user->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity = $cartItem->quantity + $request->quantity;

            $cartItem->save();

            return api_response_success([
                'message' => 'تم تحديث بيانات المنتج بنجاح',
            ]);
        }

        // Create a new cart item   
        $data['product_id'] = $request->product_id;
        $data['quantity'] = $request->quantity;

        CartItem::create($data);

        return api_response_success([
            'message' => 'تم إضافة المنتج لسلة الشراء بنجاح'
        ]);

    }

    public function deleteCartItem(Request $request , $id)
    {
        try {
            $user = sanctum()->user();
            $cartItem = CartItem::where('user_id', $user->id)
                ->where('product_id', $id)
                ->first();
            
            $cartItem->delete();

            return api_response_success('تم حذف العنصر بنجاح');
        } catch (\Throwable $th) {
            return api_response_error();
        }
    }


}

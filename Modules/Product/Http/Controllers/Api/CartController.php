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
use Modules\Order\Entities\Order;
use Modules\Product\Entities\Product;
use Modules\Type\Entities\Type;

class CartController extends Controller
{

    public function index(Request $request)
    {
        $user = sanctum()->user();
        $cartItems = $user->cartItems;
        $type = Type::where('id', $request->type)->first();
        $shipping_fee = $type->shipping_fee;

        $subtotal = $cartItems->sum(function ($cartItem) {
            return $cartItem->subtotal;
        });

        $discount = 0;
        $couponCode = null;

        if (sizeof($cartItems) > 0) {
            $couponCode = $cartItems->first()->coupon;
            $coupon = Coupon::where('code', $couponCode)->first();

            if ($coupon) {
                $discount = $subtotal * $coupon->discount / 100;
            }
        }

        $total = $subtotal - $discount;

        if ($total > $type->free_shipping) {
            $shipping_fee = 0;
        } else {
            $shipping_fee = $type->shipping_fee;
        }


        return api_response_success([
            'cart_items' => CartResource::collection($cartItems)->response()->getData(true),
            'subtotal' => (float) $subtotal,
            'discount' => (float) $discount,
            'total' => number_format($total, 2),
            'delivery' => (float) $shipping_fee
        ]);
    }

    public function addItem(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'numeric']
        ], [], [
            'product_id' => locale() == 'en' ? 'Product' : 'المنتج',
            'quantity' => locale() == 'en' ? 'Quantity' : 'الكمية'
        ]);

        if ($validator->fails()) {
            return api_response_error($validator->errors()->first());
        }

        $user = sanctum()->user();
        $todayOrders = Order::where('user_id', $user->id)->whereDate('created_at', today())->get();
        $data['user_id'] = $user->id;
        $product = Product::find($request->product_id);
        $cartItem = CartItem::where('user_id', $user->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            foreach ($todayOrders as $order) {
                if ($order->items()->contains('product_id', $request->product_id)) {
                    if ($cartItem->quantity + $request->quantity > $product->getMaximum()) {
                        return api_response_error('لقد تعديت الحد الاقصي للطلب اليوم من هذا المنتج');
                    }
                }
            }

            $quantity = $cartItem->quantity + $request->quantity;

            if ($product->getMaximum() != 0 && ($quantity > $product->getMaximum())) {
                return api_response_error('لا يمكن طلب أكثر من ' . $product->getMaximum() . ' من هذا المنتج');
            }

            $cartItem->quantity = $cartItem->quantity + $request->quantity;

            $cartItem->save();

            return api_response_success([
                'message' => 'تم تحديث بيانات المنتج بنجاح',
            ]);
        }

        foreach ($todayOrders as $order) {
            if ($order->items()->contains('product_id', $request->product_id)) {
                if ($cartItem->quantity + $request->quantity > $product->getMaximum()) {
                    return api_response_error('لقد تعديت الحد الاقصي للطلب اليوم من هذا المنتج');
                }
            }
        }


        if ($product->getMaximum() != 0 && ($request->quantity > $product->getMaximum())) {
            return api_response_error('لا يمكن طلب أكثر من ' . $product->getMaximum() . ' من هذا المنتج');
        }

        // Create a new cart item   
        $data['product_id'] = $request->product_id;
        $data['quantity'] = $request->quantity;

        CartItem::create($data);

        return api_response_success([
            'message' => 'تم إضافة المنتج لسلة الشراء بنجاح'
        ]);
    }

    public function deleteCartItem(Request $request, $id)
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

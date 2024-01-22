<?php

namespace Modules\Order\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Coupon\Entities\Coupon;
use Modules\Order\Entities\Order;
use Modules\Order\Transformers\OrderResource;
use Modules\Product\Entities\Product;
use Modules\Type\Entities\Type;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        try {
            $orders = Order::orderByDesc('id')->where('user_id' , sanctum()->id())->paginate(10);

            $data = OrderResource::collection($orders)->response()->getData(true);

            return api_response_success($data);

        } catch (\Throwable $th) {
            return api_response_error();
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('order::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'address_id' => ['required', 'not_in:0']
            // 'payment_method' => ['required']
        ], [], [
            'address_id' => 'العنوان'
        ]);

        if ($validation->fails()) {
            return api_response_error($validation->errors()->first());
        }

        $user = sanctum()->user();
        $cartItems = $user->cartItems;

        if (!sizeof($cartItems) > 0) {
            return api_response_error('لا توجد منتجات في سلة الشراء ');
        }

        $subtotal = $cartItems->sum(function ($cartItem) {
            return $cartItem->subtotal;
        });

        $discount = 0;
        $couponCode = null;
        
        $couponCode = $cartItems->first()->coupon;
        $coupon = Coupon::where('code', $couponCode)->first();

        if ($coupon) {
            $discount = $subtotal * $coupon->discount/100;
        }

        $total = $subtotal - $discount;
        $minimum = Type::where('id' , $request->type_id)->first()->minimum;

        if ($total < $minimum) {
            return api_response_error('أقل قيمة ممكنة  لإتمام الطلب هي : '.$minimum);
        }

        $order = Order::create([
            'user_id' => $user->id,
            'address_id' => $request['address_id'],
            'total' => $total,
            'coupon_discount' => $discount,
            'status' => 'preparing',
            'notes' => $request['notes'],
            'order_option' => 'delivery',
            'payment_status' => 'cash',
        ]);

        foreach ($cartItems as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->subtotal
            ]);
            
            $product = Product::where('id' , $item->product_id)->first();

            if ($product->convert1 != 0) {
                $quantity = $item->quantity * $product->convert1;
                
            }elseif ($product->convert2 != 0) {
                $quantity = $item->quantity * $product->convert1 * $product->convert2;
                
            }else{
                $quantity = $item->quantity;
            }
            $product->decrement('quantity' ,$quantity);
            

            $item->delete();
        }

        return api_response_success([
            'order' => new OrderResource($order),
            'message' => 'تم إتمام الطلب بنجاح'
        ]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        try {
            $order = Order::all()->find($id);

            $data = new OrderResource($order);

            return api_response_success($data);

        } catch (\Throwable $th) {
            return api_response_error();
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('order::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}

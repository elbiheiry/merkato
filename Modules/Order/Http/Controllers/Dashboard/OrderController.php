<?php

namespace Modules\Order\Http\Controllers\Dashboard;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Routing\Controller;
use Modules\Order\Entities\Order;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:عرض الطلبات')->only('index');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $orders = Order::orderByDesc('id')->paginate(20);
        
        return view('order::index' , ['orders' => $orders]);
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
        //
    }

    /**
     * Show the specified resource.
     * @param Order $order
     * @return Renderable
     */
    public function show(Order $order)
    {
        return view('order::show' , ['order' => $order]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Order $order
     * @return Renderable
     */
    public function edit(Order $order)
    {
        // return view('order::edit' , ['order' => $order]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Order $order
     * @return Renderable
     */
    public function update(Request $request, Order $order)
    {
        $order->update([
            'status' => $request->status
        ]);

        return redirect()->route('admin.order.index');
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

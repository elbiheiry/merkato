<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Auth\Entities\User;
use Modules\Category\Entities\Category;
use Modules\Coupon\Entities\Coupon;
use Modules\Order\Entities\Order;
use Modules\Product\Entities\Product;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $categories = Category::count();
        $users = User::count();
        $products = Product::count();
        $coupons = Coupon::count();
        $orders = Order::count();

        $last_orders = Order::all()->sortByDesc('id')->take(5);

        return view('dashboard::index' , [
            'categories' => $categories,
            'users' => $users,
            'products' => $products,
            'coupons' => $coupons,
            'orders' => $orders,
            'last_orders' => $last_orders
        ]);
    }
}

<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Auth\Entities\User;
use Modules\Category\Entities\Category;
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

        return view('dashboard::index' , [
            'categories' => $categories,
            'users' => $users,
            'products' => $products
        ]);
    }
}

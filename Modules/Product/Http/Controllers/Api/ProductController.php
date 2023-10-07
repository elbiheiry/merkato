<?php

namespace Modules\Product\Http\Controllers\Api;

use App\Filters\ProductFilter;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Product;
use Modules\Product\Transformers\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(ProductFilter $filter)
    {
        try {
            $products = Product::filter($filter)->orderByDesc('id')->get();
            $data = ProductResource::collection($products)->response()->getData();

            return api_response_success($data);
        } catch (\Throwable $th) {
            return api_response_error();
        }
    }
}

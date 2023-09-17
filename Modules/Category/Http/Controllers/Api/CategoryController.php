<?php

namespace Modules\Category\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Modules\Category\Transformers\CategoryResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        try {
            $categories = Category::all()->except(['created_at' , 'updated_at'])->sortByDesc('id');
            $data = CategoryResource::collection($categories)->response()->getData();

            return api_response_success($data);
        } catch (\Throwable $th) {
            return api_response_error();
        }
    }

    /**
     * Show the specified resource.
     * @param string $slug
     * @return Renderable
     */
    public function show($slug)
    {
        try {
            $category = Category::where('slug' , $slug)->first();

            $data = new CategoryResource($category);

            return api_response_success($data);
        } catch (\Throwable $th) {
            return api_response_error();
        }
    }
}

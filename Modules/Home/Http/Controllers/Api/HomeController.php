<?php

namespace Modules\Home\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Modules\Category\Transformers\CategoryResource;
use Modules\Home\Entities\Banner;
use Modules\Home\Entities\Offer;
use Modules\Home\Transformers\BannerResource;
use Modules\Home\Transformers\OfferResource;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        try {
            $offers = Offer::all()->except('id' , 'created_at' , 'updated_at');
            $banner = Banner::first();
            $categories = Category::all()->except(['created_at' , 'updated_at'])->sortByDesc('id');

            return api_response_success([
                'banner' => new BannerResource($banner),
                'offers' => OfferResource::collection($offers)->response()->getData(true),
                'categories' => CategoryResource::collection($categories)->response()->getData(true)
            ]);

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
        return view('home::create');
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
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('home::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('home::edit');
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

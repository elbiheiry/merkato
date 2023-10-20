<?php

namespace Modules\Page\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Page\Entities\Page;
use Modules\Page\Transformers\PageResource;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        try {
            $categories = Page::all()->except(['created_at' , 'updated_at'])->sortByDesc('id');
            $data = PageResource::collection($categories)->response()->getData();

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
        return view('page::create');
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
     * @param string $slug
     * @return Renderable
     */
    public function show($slug)
    {
        try {
            $page = Page::where('slug' , $slug)->first();

            $data = new PageResource($page);

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
        return view('page::edit');
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

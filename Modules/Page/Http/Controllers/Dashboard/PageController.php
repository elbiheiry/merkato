<?php

namespace Modules\Page\Http\Controllers\Dashboard;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Routing\Controller;
use Modules\Page\Entities\Page;
use Modules\Page\Http\Requests\PageRequest;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $pages = app(Pipeline::class)
            ->send(Page::select(['id','title','slug']))
            ->thenReturn()
            ->orderByDesc('id')
            ->get();
            
        return view('page::index' , ['pages' => $pages]);
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
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('page::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param Page $page
     * @return Renderable
     */
    public function edit(Page $page)
    {
        return view('page::edit' , ['page' => $page]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param PageRequest $page
     * @return Renderable
     */
    public function update(PageRequest $request, Page $page)
    {
        try {

            $page->update([
                'title' => $request->title,
                'description' => $request->description
            ]);

            $url = route('admin.page.index');
            return add_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
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

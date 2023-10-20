<?php

namespace Modules\Category\Http\Controllers\Dashboard;

use App\Traits\ImageTrait;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Modules\Category\Http\Requests\Dashboard\CategoryRequest;

class CategoryController extends Controller
{
    use ImageTrait;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $categories = app(Pipeline::class)
            ->send(Category::select(['id','name','image','slug']))
            ->thenReturn()
            ->orderByDesc('id')
            ->paginate(15);
            
        return view('category::index' , ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     * @param CategoryRequest $request
     * @return Renderable
     */
    public function store(CategoryRequest $request)
    {
        try {
            Category::create([
                'name' => $request->name,
                'image' => $this->image_manipulate($request->image , 'categories'),
                'slug' => SlugService::createSlug(Category::class , 'slug' , $request->name , ['unique' => true])
            ]);

            return add_response();
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('category::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('category::edit');
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

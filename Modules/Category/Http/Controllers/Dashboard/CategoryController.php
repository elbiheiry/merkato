<?php

namespace Modules\Category\Http\Controllers\Dashboard;

use App\Traits\ImageTrait;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Modules\Category\Http\Requests\Dashboard\CategoryRequest;

class CategoryController extends Controller
{
    use ImageTrait;

    public function __construct()
    {
        $this->middleware('permission:عرض الأقسام')->only('index');
        $this->middleware('permission:إنشاء قسم')->only('store');
        $this->middleware('permission:عرض قسم')->only('edit');
        $this->middleware('permission:تعديل قسم')->only('update');
        $this->middleware('permission:حذف قسم')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data = Category::select(['id','name','image','slug' , 'parent_id']);
        $categories = app(Pipeline::class)
            ->send($data)
            ->thenReturn()
            ->orderByDesc('id')
            ->paginate(15);

        $parentCategories = app(Pipeline::class)
            ->send($data)
            ->thenReturn()
            ->where('parent_id' , null)
            ->orderByDesc('id')
            ->get();

        return view('category::index' , [
            'categories' => $categories,
            'parentCategories' => $parentCategories
        ]);
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
                'parent_id' => $request->parent_id == 0 ? null : $request->parent_id,
                'name' => $request->name,
                'image' => $this->image_manipulate($request->image , 'categories'),
                'slug' => SlugService::createSlug(Category::class , 'slug' , $request->name , ['unique' => true])
            ]);

            $url = route('admin.category.index');
            return add_response($url);
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
     * @param Category $category
     * @return Renderable
     */
    public function edit(Category $category)
    {
        $parentCategories = Category::select(['id','name','image','slug' , 'parent_id'])
                            ->where('parent_id' , null)
                            ->orderByDesc('id')
                            ->get();

        return view('category::edit' , [
            'category' => $category,
            'parentCategories' => $parentCategories
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param CategoryRequest $request
     * @param Category $category
     * @return Renderable
     */
    public function update(CategoryRequest $request, Category $category)
    {
        try{
            $data = $request->all();
            if ($request->name != $category->name) {
                $data['slug'] = SlugService::createSlug(Category::class , 'slug' , $request->name , ['unique' => true]);
            }

            if ($request->has('image')) {
                $this->image_delete($category->image , 'categories');
                $data['image'] = $this->image_manipulate($request->image , 'categories');
            }

            $data['parent_id'] = $request->parent_id == 0 ? null : $request->parent_id;

            $category->update($data);

            $url = route('admin.category.index');
            return update_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param Category $category
     * @return Renderable
     */
    public function destroy(Category $category)
    {
        $this->image_delete($category->image , 'categories');
        $category->delete();

        return redirect()->back();
    }
}

<?php

namespace Modules\Product\Http\Controllers\Dashboard;

use App\Traits\ImageTrait;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Modules\Product\Entities\Product;
use Modules\Product\Http\Requests\ProductRequest;
use Modules\Type\Entities\Type;

class ProductController extends Controller
{
    use ImageTrait;

    public function __construct()
    {
        $this->middleware('permission:عرض المنتجات')->only('index');
        $this->middleware('permission:إضافة منتج')->only('store');
        $this->middleware('permission:عرض منتج')->only('edit');
        $this->middleware('permission:تعديل منتج')->only('update');
        $this->middleware('permission:حذف منتج')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $categories = Category::where('parent_id', null)->get();
        $types = Type::all();

        $products = app(Pipeline::class)
            ->send(Product::select(['id', 'name', 'image', 'slug', 'price', 'quantity']))
            ->thenReturn()
            ->orderByDesc('id')
            ->paginate(15);

        return view('product::index', [
            'products' => $products,
            'categories' => $categories,
            'types' => $types
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('product::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param ProductRequest $request
     * @return Renderable
     */
    public function store(ProductRequest $request)
    {
        try {
            $data = $request->except('image');

            $data['image'] = $this->image_manipulate($request->image, 'products');
            $data['minimum'] = 1;
            $data['types'] = json_encode($request->types);

            Product::create($data);

            $url = route('admin.product.index');

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
        return view('product::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param Product $product
     * @return Renderable
     */
    public function edit(Product $product)
    {
        $categories = Category::all()->except('image', 'created_at', 'updated_at', 'slug')->where('parent_id', null);
        $types = Type::all();

        return view('product::edit', [
            'categories' => $categories,
            'product' => $product,
            'types' => $types
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param ProductRequest $request
     * @param int $id
     * @return Renderable
     */
    public function update(ProductRequest $request, Product $product)
    {
        try {
            $data = $request->except('image');

            if ($request->has('image')) {
                $this->image_delete($product->image, 'products');
                $data['image'] = $this->image_manipulate($request->image, 'products');
            }

            if ($request->name != $product->name) {
                $data['slug'] = SlugService::createSlug(Product::class, 'slug', $request->name, ['unique' => true]);
            }

            $product->update($data);

            $url = route('admin.product.index');

            return update_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param Product $product
     * @return Renderable
     */
    public function destroy(Product $product)
    {
        $this->image_delete($product->image, 'products');

        $product->delete();

        return redirect()->back();
    }
}

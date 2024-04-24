<?php

namespace Modules\Type\Http\Controllers\Dashboard;

use App\Traits\ImageTrait;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Modules\Type\Entities\Type;
use Modules\Type\Http\Requests\TypeRequest;

class TypeController extends Controller
{
    use ImageTrait;

    public function __construct()
    {
        $this->middleware('permission:عرض الأنواع')->only('index');
        $this->middleware('permission:إنشاء نوع')->only('store');
        $this->middleware('permission:عرض نوع')->only('edit');
        $this->middleware('permission:تعديل نوع')->only('update');
        $this->middleware('permission:حذف نوع')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $types = app(Pipeline::class)
            ->send(Type::select(['id', 'name', 'image', 'slug', 'minimum', 'free_shipping', 'shipping_fee']))
            ->thenReturn()
            ->orderByDesc('id')
            ->paginate(15);

        return view('type::index', ['types' => $types]);
    }

    /**
     * Store a newly created resource in storage.
     * @param TypeRequest $request
     * @return Renderable
     */
    public function store(TypeRequest $request)
    {
        try {
            Type::create([
                'name' => $request->name,
                'image' => $this->image_manipulate($request->image, 'types'),
                'slug' => SlugService::createSlug(Type::class, 'slug', $request->name, ['unique' => true]),
                'minimum' => $request->minimum,
                'free_shipping' => $request->free_shipping,
                'shipping_fee' => $request->shipping_fee
            ]);

            $url = route('admin.type.index');
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
        return view('type::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param Type $type
     * @return Renderable
     */
    public function edit(Type $type)
    {
        return view('type::edit', ['type' => $type]);
    }

    /**
     * Update the specified resource in storage.
     * @param TypeRequest $request
     * @param Type $type
     * @return Renderable
     */
    public function update(TypeRequest $request, Type $type)
    {
        try {
            $data = $request->all();
            if ($request->name != $type->name) {
                $data['slug'] = SlugService::createSlug(Type::class, 'slug', $request->name, ['unique' => true]);
            }

            if ($request->has('image')) {
                $this->image_delete($type->image, 'types');
                $data['image'] = $this->image_manipulate($request->image, 'types');
            }

            $type->update($data);

            $url = route('admin.type.index');
            return update_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param Type $type
     * @return Renderable
     */
    public function destroy(Type $type)
    {
        $type->delete();

        return redirect()->back();
    }
}

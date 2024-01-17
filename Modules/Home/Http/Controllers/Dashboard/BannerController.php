<?php

namespace Modules\Home\Http\Controllers\Dashboard;

use App\Traits\ImageTrait;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Home\Entities\Banner;
use Modules\Home\Http\Requests\BannerRequest;

class BannerController extends Controller
{
    use ImageTrait;

    public function __construct()
    {
        $this->middleware('permission:عرض البانرات')->only('index');
        $this->middleware('permission:إنشاء البانر')->only('store');
        $this->middleware('permission:عرض البانر')->only('edit');
        $this->middleware('permission:تعديل البانر')->only('update');
        $this->middleware('permission:حذف البانر')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $banners = Banner::all();

        return view('home::banner.index' , compact('banners'));
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
    public function store(BannerRequest $request)
    {
        try {
            $data['image'] = $this->image_manipulate($request->image , 'banners');

            Banner::create($data);

            $url = route('admin.banner.index');
            
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
        return view('home::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Banner $banner)
    {
        return view('home::banner.edit' , ['banner' => $banner]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(BannerRequest $request , Banner $banner)
    {
        try {
            if ($request->hasFile('image')) {
                $this->image_delete($banner->image , 'banners');
                $data['image'] = $this->image_manipulate($request->image , 'banners');
            }

            $banner->update($data);

            $url = route('admin.banner.index');
            
            return update_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param Banner $banner
     * @return Renderable
     */
    public function destroy(Banner $banner)
    {
        $this->image_delete($banner->image , 'banners');
        $banner->delete();

        return redirect()->back();
    }
}

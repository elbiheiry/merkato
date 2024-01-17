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
        $banner = Banner::first();

        return view('home::banner.index' , compact('banner'));
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
    public function update(BannerRequest $request)
    {
        try {
            $banner = Banner::first();

            $data = [
                'title' => $request->title,
                'subtitle' => $request->subtitle,
            ];

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
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}

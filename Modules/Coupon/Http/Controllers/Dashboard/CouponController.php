<?php

namespace Modules\Coupon\Http\Controllers\Dashboard;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Routing\Controller;
use Modules\Coupon\Entities\Coupon;
use Modules\Coupon\Http\Requests\CouponRequest;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:عرض الكوبونات')->only('index');
        $this->middleware('permission:إنشاء كوبون')->only('store');
        $this->middleware('permission:عرض كوبون')->only('edit');
        $this->middleware('permission:تعديل كوبون')->only('update');
        $this->middleware('permission:حذف كوبون')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $coupons = app(Pipeline::class)
            ->send(Coupon::select(['id','code','usage_count','max_usage','valid_till','discount']))
            ->thenReturn()
            ->orderByDesc('id')
            ->paginate(15);
            
        return view('coupon::index' , ['coupons' => $coupons]);
    }

    /**
     * Store a newly created resource in storage.
     * @param CouponRequest $request
     * @return Renderable
     */
    public function store(CouponRequest $request)
    {
        try {
            Coupon::create($request->all());

            $url = route('admin.coupon.index');
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
        return view('coupon::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param Coupon $coupon
     * @return Renderable
     */
    public function edit(Coupon $coupon)
    {
        return view('coupon::edit' , ['coupon' => $coupon]);
    }

    /**
     * Update the specified resource in storage.
     * @param CouponRequest $request
     * @param Coupon $coupon
     * @return Renderable
     */
    public function update(CouponRequest $request, Coupon $coupon)
    {
        try{
            $data = $request->all();

            $coupon->update($data);

            $url = route('admin.coupon.index');
            return update_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param Coupon $coupon
     * @return Renderable
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return redirect()->back();
    }
}

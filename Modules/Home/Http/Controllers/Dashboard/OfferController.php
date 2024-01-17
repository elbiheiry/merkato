<?php

namespace Modules\Home\Http\Controllers\Dashboard;

use App\Traits\ImageTrait;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Home\Entities\Offer;
use Modules\Home\Http\Requests\OfferRequest;
use Modules\Product\Entities\Product;

class OfferController extends Controller
{
    use ImageTrait;

    public function __construct()
    {
        $this->middleware('permission:عرض العروض')->only('index');
        $this->middleware('permission:إنشاء عرض')->only('store');
        $this->middleware('permission:عرض عرض')->only('edit');
        $this->middleware('permission:تعديل عرض')->only('update');
        $this->middleware('permission:حذف عرض')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $offers = Offer::all();
        $products = Product::all();
        
        return view('home::offer.index' , compact('offers' , 'products'));
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
     * @param OfferRequest $request
     * @return Renderable
     */
    public function store(OfferRequest $request)
    {
        try {
            Offer::create([
                'name' => $request->name,
                'image' => $this->image_manipulate($request->image , 'offers'),
                'related_products' => json_encode($request->related_products)
            ]);

            $url = route('admin.offer.index');

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
     * @param Offer $offer
     * @return Renderable
     */
    public function edit(Offer $offer)
    {
        $products = Product::all();

        return view('home::offer.edit' , compact('offer' , 'products'));
    }

    /**
     * Update the specified resource in storage.
     * @param OfferRequest $request
     * @param Offer $offer
     * @return Renderable
     */
    public function update(Request $request, Offer $offer)
    {
        try {
            $data = [
                'name' => $request->name,
                'related_products' => json_encode($request->related_products)
            ];
            if ($request->has('image')) {
                $this->image_delete($offer->image , 'offers');
                $data['image'] = $this->image_manipulate($request->image , 'offers');
            }
            $offer->update($data);

            $url = route('admin.offer.index');

            return update_response($url);
        } catch (\Throwable $th) {
            return error_response();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param Offer $offer
     * @return Renderable
     */
    public function destroy(Offer $offer)
    {
        $this->image_delete($offer->image , 'offers');
        $offer->delete();

        $url = route('admin.offer.index');

        return redirect()->back();
    }
}

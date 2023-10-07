<?php

namespace Modules\User\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\Address;
use Modules\User\Http\Requests\AddressRequest;
use Modules\User\Transformers\AddressResource;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        try {
            $addresses = Address::all()->where('user_id' , sanctum()->id())->sortByDesc('id');
            $data = AddressResource::collection($addresses)->response()->getData();

            return api_response_success($data);
        } catch (\Throwable $th) {
            return api_response_error();
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param AddressRequest $request
     * @return Renderable
     */
    public function store(AddressRequest $request)
    {
        try {
            Address::where('user_id' , sanctum()->id())->where('is_default' , 1)->update([
                'is_default' => false
            ]);
            
            $request['user_id'] = sanctum()->id();
            $request['is_default'] = true;

            $address = Address::create($request->all());

            $data = new AddressResource($address);

            return api_response_success($data);
        } catch (\Throwable $th) {
            return api_response_error();
        }
    }

    /**
     * Show the specified resource.
     * @param Address $address
     * @return Renderable
     */
    public function show(Address $address)
    {
        try {
            $data = new AddressResource($address);

            return api_response_success($data);
        } catch (\Throwable $th) {
            return api_response_error();
        }
    }

    /**
     * Update the specified resource in storage.
     * @param AddressRequest $request
     * @param int $id
     * @return Renderable
     */
    public function update(AddressRequest $request, Address $address)
    {
        try {
            $address->update($request->all());
            $data = new AddressResource($address);

            return api_response_success($data);
        } catch (\Throwable $th) {
            return api_response_error();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Address $address)
    {
        try {
            $address->delete();

            return api_response_success('تم حذف العنوان بنجاح');
        } catch (\Throwable $th) {
            return api_response_error();
        }
    }

    /**
     * set default address
     *
     * @param id $id
     * @return Renderable
     */
    public function setDefault($id)
    {
        try {
            Address::where('user_id' , sanctum()->id())->where('is_default' , 1)->update([
                'is_default' => false
            ]);
            Address::where('user_id' , sanctum()->id())->where('id' , $id)->update([
                'is_default' => true
            ]);

            return api_response_success('تم تحديث العنوان بنجاح');
        } catch (\Throwable $th) {
            return api_response_error();
        }
    }
}

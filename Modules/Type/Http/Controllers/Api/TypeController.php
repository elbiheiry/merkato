<?php

namespace Modules\Type\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Type\Entities\Type;
use Modules\Type\Transformers\TypeResource;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        try {
            $types = Type::orderByDesc('id')->get();

            if (sanctum()->user()->type_id != 1 || sanctum()->user()->type_id == null) {
                $types = $types->except('1');
            }
            $data = TypeResource::collection($types)->response()->getData();

            return api_response_success($data);
        } catch (\Throwable $th) {
            return api_response_error();
        }
    }

    /**
     * Show the specified resource.
     * @param string $slug
     * @return Renderable
     */
    public function show($slug)
    {
        try {
            $type = Type::where('slug' , $slug)->first();

            $data = new TypeResource($type);

            return api_response_success($data);
        } catch (\Throwable $th) {
            return api_response_error();
        }
    }
}

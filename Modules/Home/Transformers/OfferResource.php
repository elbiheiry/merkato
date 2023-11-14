<?php

namespace Modules\Home\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Product\Entities\Product;
use Modules\Product\Transformers\ProductResource;

class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $products = Product::whereIn('id' , json_decode($this->related_products))->get();
        return [
            'name' => $this->name,
            'image' => $this->image_path,
            'products' => ProductResource::collection($products)->response()->getData(true)
        ];
    }
}

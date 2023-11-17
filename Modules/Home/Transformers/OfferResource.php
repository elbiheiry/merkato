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
        $products = Product::whereIn('id' ,$this->related_products ? json_decode($this->related_products) : [])->paginate(10);
        return [
            'id' => (int) $this->id,
            'name' => (string) $this->name,
            'image' => (string) $this->image_path,
            'products' => ProductResource::collection($products)->response()->getData(true)
        ];
    }
}

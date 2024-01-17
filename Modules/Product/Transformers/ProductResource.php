<?php

namespace Modules\Product\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id' => (int) $this->id,
            'name' => (string) $this->name,
            'image' => (string) $this->image_path,
            'price' => (float) $this->getPrice(),
            'price_before_discount' => (float) $this->price_before_discount(),
            'description' => (string) $this->description,
            'slug' => (string) $this->slug,
            'has_discount' => (boolean) ($this->discount || $this->discount != 0) ? true : false,
            'quantity' => (float) $this->quantity,
            'maximum' => (float) $this->maximum,
            'inCart' => (boolean) $this->isInCart(),
            'quantity_in_cart' => (int) $this->quantityInCart()
        ];

        return $data;
    }
}

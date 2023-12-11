<?php

namespace Modules\Type\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class TypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => (int) $this->id,
            'name' => (string) $this->name,
            'slug' => (string) $this->slug,
            'image' => (string) $this->image_path,
            'minimum_for_order' => (float) $this->minimum,
            'free_shipping' => (float) $this->free_shipping
        ];
    }
}

<?php

namespace Modules\User\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'region' => (string) $this->region,
            'area' => (string) $this->area,
            'address' => (string) $this->address,
            'facility' => (int) $this->facility,
            'floor' => (int) $this->floor,
            'is_default' => (boolean) $this->is_default
        ];
    }
}

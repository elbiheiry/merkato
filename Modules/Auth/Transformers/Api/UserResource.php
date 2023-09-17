<?php

namespace Modules\Auth\Transformers\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'email' => (string) $this->email,
            'mobile' => (string) $this->mobile,
            'floor' => (int) $this->floor,
            'facility_name' => (int) $this->facility_name,
            'facility_number' => (int) $this->facility_number,
            'street' => (string) $this->street,
            'district' => (string) $this->district,
            'city' => (string) $this->city
        ];
    }
}

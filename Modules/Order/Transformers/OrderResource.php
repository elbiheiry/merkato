<?php

namespace Modules\Order\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\User\Transformers\AddressResource;

class OrderResource extends JsonResource
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
            'address' => new AddressResource($this->address),
            'total' => (double) $this->total,
            'status' => (string) $this->status,
            'payment_method' => (string) $this->payment_status,
            'notes' => (string) $this->notes,
            'items' => OrderItemResource::collection($this->items)->response()->getData(true)
        ];
    }
}

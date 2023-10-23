<?php

namespace Modules\Order\Transformers;

use Carbon\Carbon;
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
            'name' => (string) 'طلب بتاريخ : ' .Carbon::parse($this->created_at)->format('d/m/y'),
            'orders_count' => (int) $this->items->count(),
            'order_number' => (int) $this->id,
            'address' => new AddressResource($this->address),
            'total' => (double) $this->total,
            'status' => (string) $this->status,
            'payment_method' => (string) $this->payment_status,
            'notes' => (string) $this->notes,
            'items' => OrderItemResource::collection($this->items)->response()->getData(true)
        ];
    }
}

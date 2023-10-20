<?php

namespace Modules\Home\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
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
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'image' => $this->image_path
        ];
    }
}

<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'gallery_type_id' => $this->gallery_type_id,
            'id' => $this->id,
            'title' => $this->title,
            'order' => $this->order,
            'image_small' => $this->image_small,
            'image_large' => $this->image_large,
            'status' => $this->status,
        ];
    }
}

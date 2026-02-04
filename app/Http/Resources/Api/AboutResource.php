<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
            'id' => $this->id,
            'unit_id' => $this->unit_id,
            'title' => $this->title,
            'sub_title' => $this->sub_title,
            'description' => $this->description,
            'founded_at' => $this->founded_at,
            'image' => $this->image,
            'body' => $this->body,
            'status' => $this->status,
        ];
    }
}
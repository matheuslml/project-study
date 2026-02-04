<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShortcutWebResource extends JsonResource
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
            'title' => $this->title,
            'img_url' => $this->img_url,
            'link_url' => $this->link_url,
            'order' => $this->order,
            'status' => $this->status
        ];
    }
}

<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OmbudsmanCategoryResource extends JsonResource
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
            'type_request_id' => $this->type_request_id,
            'access_id' => $this->access_id,
            'name' => $this->name,
            'email' => $this->email,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
        ];
    }
}
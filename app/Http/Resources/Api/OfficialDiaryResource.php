<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfficialDiaryResource extends JsonResource
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
            'edition' => $this->edition,
            'extra_edition' => $this->extra_edition,
            'published_at' => $this->published_at,
            'description' => $this->description,
            'type' => $this->type,
            'status' => $this->status
        ];
    }
}

<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LegislationCategoryResource extends JsonResource
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
            'base_id' => $this->base_id,
            'vinculo_id' => $this->vinculo_id,
            'status' => $this->status,
            'active' => $this->active,
        ];
    }
}

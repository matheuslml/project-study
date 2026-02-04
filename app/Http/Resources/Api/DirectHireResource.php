<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DirectHireResource extends JsonResource
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
            'modality_id' => $this->modality_id,
            'situation_id' => $this->situation_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'login' => $this->login,
            'bidding' => $this->bidding,
            'notice' => $this->notice,
            'process' => $this->process,
            'value_min' => $this->value_min,
            'value_max' => $this->value_max,
            'published_at' => $this->published_at,
            'realized_at' => $this->realized_at,
            'local' => $this->local,
            'content' => $this->content,
            'status' => $this->status,
        ];
    }
}
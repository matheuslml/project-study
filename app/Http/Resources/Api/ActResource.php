<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActResource extends JsonResource
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
            'official_diary_id' => $this->official_diary_id,
            'act_topic_id' => $this->act_topic_id,
            'act_type' => $this->act_type,
            'title' => $this->title,
            'excerpt' => $this->excerpt,
            'body' => $this->body,
            'published_at' => $this->published_at,
            'order' => $this->order,
            'status' => $this->status
        ];
    }
}

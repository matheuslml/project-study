<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RevenueResource extends JsonResource
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
            'type_id' => $this->type_id,
            'description' => $this->description,
            'value' => $this->value,
            'receipt_at' => $this->receipt_at,
            'collection_initial_at' => $this->collection_initial_at,
            'collection_final_at' => $this->collection_final_at,
            'referent' => $this->referent,
            'notes' => $this->notes,
            'status' => $this->status,
        ];
    }
}
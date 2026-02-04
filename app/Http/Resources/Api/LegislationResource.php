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
            'category_id' => $this->category_id,
            'situation_id' => $this->situation_id,
            'ementa' => $this->ementa,
            'number' => $this->number,
            'number_complement' => $this->number_complement,
            'date' => $this->date,
            'initial_term' => $this->initial_term,
            'final_term' => $this->final_term,
            'information' => $this->information,
            'excerpt' => $this->excerpt,
            'body' => $this->body,
            'meta_description' => $this->meta_description,
            'status' => $this->status,
        ];
    }
}

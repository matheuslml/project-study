<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartamentResource extends JsonResource
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
            'departament' => $this->departament,
            'sigla' => $this->sigla,
            'code' => $this->code,
            'unit_id' => $this->unit_id,
            'responsible' => $this->responsible,
            'phone' => $this->phone,
            'email' => $this->email,
        ];
    }
}

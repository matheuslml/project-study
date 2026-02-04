<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UnitResource extends JsonResource
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
            'name' => $this->name,
            'sigla' => $this->sigla,
            'organization_id' => $this->organization_id,
            'phone' => $this->phone,
            'email' => $this->email,
            'operation' => $this->operation,
            'address' => $this->address,
            'google_maps_link' => $this->google_maps_link,
            'google_maps_iframe' => $this->google_maps_iframe,
            'web' => $this->web,
            'logo' => $this->logo,
            'icon' => $this->icon,
            'document' => $this->document,
        ];
    }
}

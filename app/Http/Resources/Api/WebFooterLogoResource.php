<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WebFooterLogoResource extends JsonResource
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
            'web_footer_id' => $this->web_footer_id,
            'title' => $this->title,
            'logo_url' => $this->logo_url,
            'link_url' => $this->link_url,
            'status' => $this->status,
        ];
    }
}

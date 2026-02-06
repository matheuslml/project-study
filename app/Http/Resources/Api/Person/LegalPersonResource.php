<?php

namespace App\Http\Resources\Api\Person;

use App\Http\Resources\Api\Address\AddressResource;
use App\Http\Resources\Api\EmailResource;
use App\Http\Resources\Api\PhoneResource;
use App\Http\Resources\Api\SocialMediaResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\PersonResource;

class LegalPersonResource extends JsonResource
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
            $this->merge(
                PersonResource::make($this->personable),
            ),
            $this->merge(
                \App\Http\Resources\Api\IndividualPersonResource::make($this),
            ),
            'phones' => $this->merge(PhoneResource::collection($this->personable->phones))->data,
            'addresses' => $this->merge(AddressResource::collection($this->personable->addresses))->data,
            'emails' => $this->merge(EmailResource::collection($this->personable->emails))->data,
            'social_media' => $this->merge(SocialMediaResource::collection($this->personable->social_media))->data,
        ];
    }
}

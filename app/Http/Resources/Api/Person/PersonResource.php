<?php

namespace App\Http\Resources\Api\Person;

use App\Http\Resources\Api\Address\AddressResource;
use App\Http\Resources\Api\EmailResource;
use App\Http\Resources\Api\PhoneResource;
use App\Http\Resources\Api\SocialMediaResource;
use App\Models\IndividualPerson;
use App\Models\LegalPerson;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonResource extends JsonResource
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
                \App\Http\Resources\Api\PersonResource::make($this),
            ),
            $this->mergeWhen(
                $this->personable_type === IndividualPerson::class,
                \App\Http\Resources\Api\IndividualPersonResource::make($this->personable)
            ),
            $this->mergeWhen(
                $this->personable_type === LegalPerson::class,
                \App\Http\Resources\Api\LegalPersonResource::make($this->personable)
            ),
            'phones' => $this->merge(PhoneResource::collection($this->phones))->data,
            'addresses' => $this->merge(AddressResource::collection($this->addresses))->data,
            'emails' => $this->merge(EmailResource::collection($this->emails))->data,
            'social_media' => $this->merge(SocialMediaResource::collection($this->social_media))->data,
        ];
    }
}

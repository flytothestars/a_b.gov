<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class BusinessContactsResource extends JsonResource
{
    public function toArray($request) : array
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'phone_number' => $this->phone_number,
            'mio_id' => $this->mio_id,
            'business_id' => $this->business_id,
            'client' => $this->client ?? ''
        ];
    }
}

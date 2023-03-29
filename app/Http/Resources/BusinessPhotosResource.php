<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class BusinessPhotosResource extends JsonResource
{
    public function toArray($request) : array
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'photo_url' => $this->photo_url,
            'mio_id' => $this->mio_id,
            'business_id' => $this->business_id,
        ];
    }
}

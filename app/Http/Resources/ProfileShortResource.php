<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileShortResource extends JsonResource
{
    public function toArray($request) : array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'second_name' => $this->second_name,
            'last_name' => $this->last_name,
            'fio' => $this->last_name . ' ' . $this->first_name,
            'iin' => $this->iin,
        ];
    }

}

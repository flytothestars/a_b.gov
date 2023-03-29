<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DistributorOrganizationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'full_name' => $this->full_name,
            'iin' => $this->iin,
            'position' => $this->position,
            'industry' => new DictResource($this->industry),
            'is_individual' => $this->is_individual,
            'mio_id' => $this->mio_id,
            'profile' => new BusinessProfileResource($this->profile),
        ];

    }
}

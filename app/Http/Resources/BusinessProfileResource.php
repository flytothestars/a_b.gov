<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BusinessProfileResource extends JsonResource
{
    public function toArray($request) : array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'second_name' => $this->second_name,
            'last_name' => $this->last_name,
            'user' => new UserResource($this->user),
            'company_name' => $this->company_name,
            'iin' => $this->iin,
            'position' => $this->position,
            'industry' => new DictResource($this->industry),
            'fio' => $this->last_name . ' ' . $this->first_name,
            'department' => new DepartmentResource($this->department)
        ];
    }

}

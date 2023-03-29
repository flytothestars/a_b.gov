<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'appeals_list' => AppealShortResource::collection($this->user->appeals),
            'position' => $this->position,
            'industry' => new DictResource($this->industry),
            'fio' => $this->last_name . ' ' . $this->first_name,
            'organization' => new OrganizationResource($this->organization),
            'department' => new DepartmentResource($this->department)
        ];
    }

}

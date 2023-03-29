<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request) : array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'lastName' => optional($this->profile)->last_name,
            'firstName' => optional($this->profile)->first_name,
            'secondName' => optional($this->profile)->second_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'roles' => RoleResource::collection($this->roles),
            'department' => optional($this->profile)->department ? new DepartmentResource($this->profile->department) : null,
            'position' => optional($this->profile)->position
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ActivityTypeResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'tags' => DictResource::collection($this->tags),
            'activity_node_type' => new DictResource($this->activityNodeType),
        ];
    }
}

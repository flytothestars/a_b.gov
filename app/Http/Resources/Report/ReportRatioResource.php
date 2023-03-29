<?php

namespace App\Http\Resources\Report;

use App\Http\Resources\DictResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportRatioResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'       => $this->resource[ 'id' ],
            'name'     => $this->resource[ 'name' ],
            'value'    => (float)$this->resource[ 'value' ],
            'exists'   => (float)$this->resource[ 'exists' ],
            'ratio_id' => $this->resource[ 'ratio_id' ],
        ];
    }
}

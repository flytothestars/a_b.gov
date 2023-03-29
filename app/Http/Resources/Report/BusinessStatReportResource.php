<?php

namespace App\Http\Resources\Report;

use App\Repositories\Enums\Reports\IPTRReportRatiosEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class BusinessStatReportResource extends JsonResource
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
            'registered_month'             => $this->resource[ 'registered_month' ],
            'new_month'                    => $this->resource[ 'new_month' ],
            'registeredDistrict'     => $this->resource[ 'registeredDistrict' ],
            'newDistrict'            => $this->resource[ 'newDistrict' ],
            'new_years'            => $this->resource[ 'new_years' ],
            'registered_years'        => $this->resource[ 'registered_years' ],
        ];
    }
}

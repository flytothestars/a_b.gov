<?php

namespace App\Http\Resources\Report;

use App\Repositories\Enums\Reports\IPTRReportRatiosEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class PRTReportResource extends JsonResource
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
           [
               'month'  => $this->resource[ 'month' ],
               'TOP_IFO_increasing'  => $this->resource[ 'TOP_IFO_increasing' ],
               'TOP_IFO_decreasing'  => $this->resource[ 'TOP_IFO_decreasing' ],
               'TOP_export_increasing'  => $this->resource[ 'TOP_export_increasing' ],
               'TOP_export_decreasing'  => $this->resource[ 'TOP_export_decreasing' ],
               'TOP_invest_increasing'  => $this->resource[ 'TOP_invest_increasing' ],
               'TOP_invest_decreasing'  => $this->resource[ 'TOP_invest_decreasing' ],
           ]
        ];
    }
}

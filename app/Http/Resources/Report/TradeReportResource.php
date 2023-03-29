<?php

namespace App\Http\Resources\Report;

use App\Repositories\Enums\Reports\ITradeReportRatioEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class TradeReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    final public function toArray($request): array
    {
        return [
            'month' => $this->resource[ 'month' ],
            'years' => $this->resource[ 'years' ],
        ];
    }
}

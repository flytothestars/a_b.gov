<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppealShortResource extends JsonResource
{
    public function toArray($request) : array
    {
        return [
            'id' => $this->id,
            'client_appeal_status' => new DictResource($this->clientAppealStatus),
            'appeal_status' => new DictResource($this->appealStatus),
            'appeal_source_type' => new DictResource($this->appealSourceType),
            'category' => new DictResource($this->category),
            'industry' => $this->industry ? new DictResource($this->industry) : null,
            'type' => new DictResource($this->type),
            'district' => new DictResource($this->district),
//            'content' => in_array((new DictResource($this->category))['name'], ['Финансирование', 'Бесплатное обучение', 'Потребность в кадрах']) ? '' : $this->content,
            'content' => $this->content,
            'iin' => $this->business->organization->iin ?? null,
            'comment' => $this->comment,
            'create_date' => $this->createDate,
            'update_date' => $this->updateDate,
            'create_date_at' => $this->created_at,
            'update_date_at' => $this->updated_at,
            'business' => new BusinessShortResource($this->business),
            'client' => new ProfileShortResource(optional($this->client)->profile),
            'distributor' => new ProfileShortResource(optional($this->distributor)->profile),
            'executor' => new ProfileShortResource(optional($this->executor)->profile),
            'co_executor' => new ProfileShortResource(optional($this->coExecutor)->profile),
            'flow_type' => new DictResource($this->flowType),
            'upi_curator' => new ProfileShortResource(optional($this->upiCurator)->profile),
            'district_curator' => new ProfileShortResource(optional($this->districtCurator)->profile),
            'appeal_no' => $this->appeal_no
        ];
    }

}

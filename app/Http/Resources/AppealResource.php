<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class AppealResource extends JsonResource
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
            'content' => $this->content,
            'comment' => $this->comment,
            'create_date' => $this->createDate,
            'update_date' => $this->updateDate,
            'create_date_at' => $this->createDate,
            'update_date_at' => $this->updated_at,
            'client' => new ProfileResource(optional($this->client)->profile),
            'distributor' => new ProfileResource(optional($this->distributor)->profile),
            'executor' => new ProfileResource(optional($this->executor)->profile),
            'co_executor' => new ProfileResource(optional($this->coExecutor)->profile),
            'business' => new BusinessResource($this->business),
            'flow_type' => new DictResource($this->flowType),
            'iefiles' => new IEFilesResource($this->ieappealDocument),
            'upi_curator' => new ProfileResource(optional($this->upiCurator)->profile),
            'district_curator' => new ProfileResource(optional($this->districtCurator)->profile),

            'client_documents' => AppealDocumentResource::collection($this->appealClientDocuments),
            'manager_documents' => AppealDocumentResource::collection($this->appealManagerDocuments),
            'business_photo' => $this->business ? BusinessPhotosResource::collection($this->business->businessPhotos) : null,
            'appeal_no' => $this->appeal_no,
            'in_camunda' => $this->in_camunda,
            'qolday_product_or_comment' => AppealQoldayProductResource::collection($this->appealQoldayProducts)
        ];
    }

}

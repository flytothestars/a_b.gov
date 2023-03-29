<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppealHistoryResource extends JsonResource
{
    public function toArray($request) : array
    {
        return [
            'id' => $this->id,
            'comment' => $this->comment,
            'client_appeal_status' => new DictResource($this->clientAppealStatus),
            'appeal_action_type' => new DictResource($this->appealActionType),
            'appeal_status' => new DictResource($this->appealStatus),
            'created_by' => new ProfileResource(optional($this->createdBy)->profile),
            'distributor' => new ProfileResource(optional($this->distributor)->profile),
            'executor' => new ProfileResource(optional($this->executor)->profile),
            'co_executor' => new ProfileResource(optional($this->coExecutor)->profile),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'action_type_count' => $this->action_type_count,
            'documents' => AppealDocumentHistoryResource::collection($this->historyDocuments ?? []),
        ];
    }
}

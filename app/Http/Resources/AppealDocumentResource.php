<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class AppealDocumentResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'                   => $this->id,
            'document_source_type' => new DictResource($this->documentSourceType),
            'description'          => $this->description,
            'created_by'           => new ProfileShortResource(optional($this->createdBy)->profile),
            'file_path'            => $this->filePath,
            'link'                 => Storage::disk('public')
                                             ->exists($this->filePath)
                ? Storage::disk('public')
                         ->url($this->filePath)
                : '',
        ];
    }
}

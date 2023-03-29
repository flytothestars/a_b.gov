<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IEFilesResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'appeal_id' => $this->appeal_id,
            'user_id' => $this->user_id,
            'file1' => $this->file1,
            'file2' => $this->file2,
            'file3' => $this->file3,
            'file4' => $this->file4,
            'file5' => $this->file5,
            'file6' => $this->file6,
            'file7' => $this->file7,
            'file8' => $this->file8,
            'file9' => $this->file9,
            'file10' => $this->file10,
            'file11' => $this->file11,
            'file12' => $this->file12,
            'file13' => $this->file13,
            
        ];

    }
}

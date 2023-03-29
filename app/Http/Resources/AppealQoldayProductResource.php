<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Resources\Json\JsonResource;

class AppealQoldayProductResource extends JsonResource
{
    public function toArray($request) : array
    {
        return [
            'id' => $this->id,
            'comment' => $this->comment,
            'category' => $this->category ? $this->category->name : null,
        ];
    }

}

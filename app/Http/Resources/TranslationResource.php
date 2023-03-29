<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TranslationResource extends JsonResource
{
    public function toArray($request) : array
    {
        return [
            "language" => $this->language,
            "content" => $this->content
        ];
    }
}

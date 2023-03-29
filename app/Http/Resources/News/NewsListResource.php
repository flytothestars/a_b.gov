<?php

namespace App\Http\Resources\News;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsListResource extends JsonResource
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
            'id'           => $this->id,
            'header'       => $this->header,
            'create_date'  => Carbon::createFromFormat('Y-m-d H:i:s',$this->create_date)->format('Y-m-d'),
            'is_published' => $this->is_published,
            'category'     => new CategoryResource($this->newsCategory),
            'translations' => $this->translations,
        ];
    }
}

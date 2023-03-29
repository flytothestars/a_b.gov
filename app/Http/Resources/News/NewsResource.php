<?php

namespace App\Http\Resources\News;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
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
        $translation = $this->translations()
                            ->where('language', 'kk')
                            ->first()
        ;
        $thumbnail   = $this->files()
                            ->where('file_type', 'thumbnail')
                            ->first()
        ;
        return [
            'id'           => $this->id,
            'category_id'  => $this->news_category_id,
            'createDate'   => $this->create_date
                ? Carbon::parse($this->create_date)
                        ->format('Y-m-d')
                : Carbon::now()
                        ->format('Y-m-d'),
            'is_published' => $this->is_published,
            'image'        => optional($thumbnail)->path,
            'newsRu'       => [
                'header'  => $this->header,
                'lead'    => $this->lead,
                'content' => $this->content,
            ],
            'newsKk'       => [
                'header'  => $translation && $translation->content && array_key_exists('header', $translation->content)
                    ? $translation->content[ 'header' ]
                    : '',
                'lead'    => $translation && $translation->content && array_key_exists('lead', $translation->content)
                    ? $translation->content[ 'lead' ]
                    : '',
                'content' => $translation && $translation->content && array_key_exists('content', $translation->content)
                    ? $translation->content[ 'content' ]
                    : '',
            ],
        ];
    }
}

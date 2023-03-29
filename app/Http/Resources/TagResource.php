<?php

namespace App\Http\Resources;

use App\Http\Controllers\API\TagController;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\ResourceLinks\HasLinks;

class TagResource extends JsonResource
{
    use HasLinks;

    public function toArray($request) : array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'translations' => TranslationResource::collection($this->translations),
            'project' => new DictResource($this->project),
            'links' => $this->links(TagController::class),
        ];
    }

    public static function collection($resource)
    {
        return parent::collection($resource)->additional([
            'meta' => [
                'entity_links' => self::collectionLinks(TagController::class)
            ],
        ]);
    }
}

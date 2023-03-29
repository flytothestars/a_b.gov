<?php


namespace App\Repositories;


use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class TagRepository extends BaseRepository implements ITagRepository
{
    public function __construct(Tag $model)
    {
        parent::__construct($model);
    }

    public function allByProject(array $attributes): Collection
    {
        $projectId = $attributes['project_id'];

        //TODO fix
//        $perPage = null;
//        if(array_key_exists('per_page',$attributes))
//            $perPage = $attributes['per_page'];
//
//        $sortBy = [];
//        if(array_key_exists('sortBy',$attributes))
//            $sortBy = $attributes['sortBy'];
//
//        $sortDesc = [];
//        if(array_key_exists('sortDesc',$attributes))
//            $sortDesc = $attributes['sortDesc'];

        return parent::query()->where('project_id', $projectId)
            ->get();
    }

    public function verifyTag($projectId, $tagName): Model
    {
        $tag = parent::query()
            ->whereRaw('lower(name) like (?)', [strtolower($tagName)])
            ->first();

        if(!$tag)
            $tag = parent::create([
                'id' => Uuid::uuid4(),
                'project_id' => $projectId,
                'name' => $tagName
            ]);

        return $tag;
    }

    public function search($projectId, $text): Collection
    {
        return parent::query()
            ->where('project_id',$projectId)
            ->whereRaw('lower(name) like (?)', ["%".strtolower($text)."%"])
            ->get();
    }

    public function getByNameCI($projectId, $name): Model
    {
        return parent::query()
            ->where('project_id',$projectId)
            ->whereRaw('lower(name) like (?)', [strtolower($name)])
            ->first();
    }
}

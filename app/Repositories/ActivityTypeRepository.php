<?php


namespace App\Repositories;


use App\Models\ActivityType;
use App\Models\ActivityTypeTag;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class ActivityTypeRepository extends MioBaseRepository implements IActivityTypeRepository
{
    public function __construct(ActivityType $model)
    {
        parent::__construct($model);
    }

    public function createByParams(string $code, string $name, $tags, $parentId, $nodeTypeId, $mioId): Model
    {
        DB::beginTransaction();

        try {

            $entity = parent::create(
                [
                    'id' => Uuid::uuid4(),
                    'code' => $code,
                    'name' => $name,
                    'parent_id' => $parentId,
                    'activity_node_type_id' => $nodeTypeId,
                    'mio_id' => $mioId
                ]);

            if($tags)
                foreach ($tags as $tag)
                {
                    ActivityTypeTag::query()->create(
                        [
                            'id' => Uuid::uuid4(),
                            'activity_type_id' => $entity->id,
                            'name' => $tag
                        ]
                    );
                }

            DB::commit();

            return $entity;

        } catch (Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }
}

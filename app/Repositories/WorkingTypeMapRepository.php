<?php


namespace App\Repositories;


use App\Models\CategoryMap;
use App\Models\ServiceGroup;
use App\Models\WorkingType;
use App\Models\WorkingTypeMap;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class WorkingTypeMapRepository extends BaseRepository implements IWorkingTypeMapRepository
{
    public function __construct(WorkingTypeMap $model)
    {
        parent::__construct($model);
    }

    public function findWorkingType($activityTypeId): ?Model
    {
        $workingTypeMap = WorkingTypeMap::query()->where('activity_type_id', $activityTypeId)->first();
        if(!$workingTypeMap){
            $workingTypeId = 'd00cbf0e-8604-4f08-8de0-7d6a791f7cfe'; //other
        } else {
            $workingTypeId = $workingTypeMap->working_type_id;
        }

        return WorkingType::query()->where('id', $workingTypeId)->first();
    }
}

<?php


namespace App\Repositories;


use App\Models\ActivityType;
use App\Models\ActivityTypeTag;
use App\Models\WorkingIndustryType;
use App\Models\WorkingType;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class WorkingTypeRepository extends MioBaseRepository implements IWorkingTypeRepository
{
    public function __construct(WorkingType $model)
    {
        parent::__construct($model);
    }
}

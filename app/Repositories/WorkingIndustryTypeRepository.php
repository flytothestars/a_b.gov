<?php


namespace App\Repositories;


use App\Models\ActivityType;
use App\Models\ActivityTypeTag;
use App\Models\WorkingIndustryType;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class WorkingIndustryTypeRepository extends MioBaseRepository implements IWorkingIndustryTypeRepository
{
    public function __construct(WorkingIndustryType $model)
    {
        parent::__construct($model);
    }
}

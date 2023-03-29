<?php


namespace App\Repositories;


use App\Models\ActivityType;
use App\Models\ActivityTypeTag;
use App\Models\WorkingIndustry;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class WorkingIndustryRepository extends MioBaseRepository implements IWorkingIndustryRepository
{
    public function __construct(WorkingIndustry $model)
    {
        parent::__construct($model);
    }
}

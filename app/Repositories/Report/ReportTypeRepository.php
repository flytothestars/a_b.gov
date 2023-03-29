<?php

namespace App\Repositories\Report;

use App\Models\Report\ReportType;
use App\Repositories\BaseRepository;

class ReportTypeRepository extends BaseRepository implements IReportTypesRepository
{
    public function __construct(ReportType $model)
    {
        parent::__construct($model);
    }
}

<?php

namespace App\Repositories\GovernmentProgramsReports;

use App\Repositories\ICreatable;
use App\Repositories\IDeletable;
use App\Repositories\IFindable;
use App\Repositories\IUpdatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface IGovernmentSubsidiesReportsRepositoryContract extends ICreatable, IUpdatable, IDeletable, IFindable, IBaseReportRepositoryContract
{
}

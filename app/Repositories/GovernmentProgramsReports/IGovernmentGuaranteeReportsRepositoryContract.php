<?php

namespace App\Repositories\GovernmentProgramsReports;

use App\Repositories\ICreatable;
use App\Repositories\IDeletable;
use App\Repositories\IFindable;
use App\Repositories\IUpdatable;

interface IGovernmentGuaranteeReportsRepositoryContract extends ICreatable, IUpdatable, IDeletable, IFindable, IBaseReportRepositoryContract
{
}

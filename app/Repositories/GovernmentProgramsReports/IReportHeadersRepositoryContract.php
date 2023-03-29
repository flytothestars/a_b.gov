<?php

namespace App\Repositories\GovernmentProgramsReports;

use App\Repositories\ICreatable;
use App\Repositories\IDeletable;
use App\Repositories\IFindable;
use App\Repositories\IUpdatable;

interface IReportHeadersRepositoryContract extends ICreatable, IUpdatable, IDeletable, IFindable
{
    public function getAllReportsByDate(string $date);

}

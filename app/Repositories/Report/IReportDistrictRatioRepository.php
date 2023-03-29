<?php

namespace App\Repositories\Report;

use App\Repositories\IRepository;
use Illuminate\Support\Collection as SupportCollation;

interface IReportDistrictRatioRepository extends IRepository
{

    public function fetchReportRatioList(array $attributes): SupportCollation;

}

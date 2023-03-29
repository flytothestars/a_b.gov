<?php

namespace App\Repositories\Report;

use App\Repositories\IRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollation;

interface IReportCityRatioRepository extends IRepository
{

    public function fetchReportTypeRatioList(array $attributes): array;

}

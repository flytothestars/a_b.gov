<?php

namespace App\Repositories\Report;

use App\Repositories\IRepository;
use Illuminate\Support\Collection as SupportCollation;

interface IAppealsByDistrictReportRepository extends IRepository
{

    public function getStaticsByDistricts(array $attributes): SupportCollation;
    public function getAllAppealsByStatus(array $attributes): SupportCollation;
    public function getDistrictAppealsByStatus(array $attributes,$districtId,$districtName): SupportCollation;
   
}

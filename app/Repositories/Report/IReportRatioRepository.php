<?php

namespace App\Repositories\Report;

use App\Repositories\IRepository;
use Illuminate\Database\Eloquent\Collection;

interface IReportRatioRepository extends IRepository
{

    public function getRatiosByReportTypeId(int $id, array $scope = []): Collection;

}

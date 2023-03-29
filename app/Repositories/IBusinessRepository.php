<?php

namespace App\Repositories;

use App\Repositories\Support\IAutoAssignDistributor;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface IBusinessRepository extends IRepository, IMioIntegration, IAutoAssignDistributor
{
    function getAppealBusinessById($business_id);

    function allByDistributorId($distributor_id);

    public function allByFilter(array $attributes);
    public function allByFilterDistributor(array $attributes);

    function allByDistributorIdWithPagination($distributor_id, $itemsPerPage);

    public function setWorkingType($business_id, $workingType): ?Model;
}

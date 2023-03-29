<?php

namespace App\Repositories\Report;

use App\Models\Report\ReportRatio;
use App\Repositories\BaseRepository;
use App\Repositories\Enums\Reports\IRatioScopeEnum;
use Illuminate\Database\Eloquent\Collection;

class RatioTypeRepository extends BaseRepository implements IReportRatioRepository
{
    public function __construct(ReportRatio $model)
    {
        parent::__construct($model);
    }

    final function getRatiosByReportTypeId(int $id, array $scope = []): Collection
    {
        $query =  $this
            ->query()
            ->where('report_type_id', $id)
            ;

        if(count($scope)){
            $query = $query->whereIn('scope', $scope);
        }

        return $query->get();
    }


}

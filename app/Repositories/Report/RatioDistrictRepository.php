<?php

namespace App\Repositories\Report;

use App\Models\Report\ReportDistrictRatio;
use App\Repositories\BaseRepository;
use App\Repositories\Enums\Reports\IRatioScopeEnum;
use Carbon\Carbon;
use Illuminate\Support\Collection as SupportCollation;

class RatioDistrictRepository extends BaseRepository implements IReportDistrictRatioRepository
{

    private IReportRatioRepository $reportRatioRepository;

    public function __construct(
        ReportDistrictRatio $model,
        IReportRatioRepository $reportRatioRepository
    )
    {
        parent::__construct($model);
        $this->reportRatioRepository = $reportRatioRepository;
    }

    public function fetchReportRatioList(array $attributes): SupportCollation
    {
        $type = $attributes['report_type_id'];
        $date = isset($attributes['date'])
            ? Carbon::createFromFormat('Y-m-d', $attributes['date'])
            : Carbon::now();

        $city = $attributes['city_id'] ?? null;
        $district = $attributes['district_id'] ?? null;

        $date = $date->day(1)->format('Y-m-d');
        $ratiosList = $this->reportRatioRepository->getRatiosByReportTypeId($type, [IRatioScopeEnum::RATIO_SCOPE_ALL, IRatioScopeEnum::RATIO_SCOPE_REGION]);

        $ratiosIds = $ratiosList->pluck('id')->toArray();

        $ratiosValues = $this
            ->query()
            ->where('report_type_id', $type)
            ->whereIn('ratio_id', $ratiosIds)
            ->where('date', $date)
            ->where('city_id', $city)
            ->where('district_id', $district)
            ->get();

        $ratios = $ratiosList->map(function ($item) use ($ratiosValues){
            $ratio = $ratiosValues->where('ratio_id', $item['id'])->first();
            return [
                'id'=> $item['id'],
                'name' => $item['name'],
                'value' => optional($ratio)->value,
                'exists' => $ratio !== null,
                'ratio_id'=> optional($ratio)->id,
            ];
        });


        return $ratios;

    }


}

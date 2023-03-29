<?php

namespace App\Repositories\Report;

use App\Models\Report\ReportCityRatio;
use App\Repositories\BaseRepository;
use App\Repositories\Enums\Reports\IRatioScopeEnum;
use App\Repositories\Enums\Reports\IReportTypeEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollation;

class RatioCityRepository extends BaseRepository implements IReportCityRatioRepository
{
    private IReportRatioRepository $reportRatioRepository;

    public function __construct(
        ReportCityRatio $model,
        IReportRatioRepository $reportRatioRepository
    )
    {
        parent::__construct($model);
        $this->reportRatioRepository = $reportRatioRepository;
    }

    final public function fetchReportTypeRatioList(array $attributes): array
    {
        $type = $attributes[ 'report_type_id' ];
        $date = isset($attributes[ 'date' ])
            ? Carbon::createFromFormat('Y-m-d', $attributes[ 'date' ])
            : Carbon::now();

        $reportContract = IReportTypeEnum::ReportContractsList[ $type ];

        $city = $attributes[ 'city_id' ] ?? null;

        $dateStr    = $date
            ->day(1)
            ->format('Y-m-d')
        ;
        $ratiosList = $this
            ->reportRatioRepository
            ->getRatiosByReportTypeId(
                $type,
                [
                    IRatioScopeEnum::RATIO_SCOPE_ALL,
                    IRatioScopeEnum::RATIO_SCOPE_CITY,
                ]
            );

        $ratiosIds = $ratiosList
            ->pluck('id', 'id')
            ->toArray()
        ;

        $ratiosValues = $this
            ->query()
            ->with('ratio')
            ->where('report_type_id', $type)
            ->whereIn('ratio_id', $ratiosIds)
            ->where('date', $dateStr)
            ->where('city_id', $city)
            ->get()
        ;

        $ratios = $ratiosList
            ->map(
                function ($item) use ($ratiosValues, $reportContract)
                {
                    $ratio = $ratiosValues->where('ratio_id', $item[ 'id' ])
                                          ->first()
                    ;
                    if (in_array($item[ 'id' ], $reportContract::MonthRatiosList, true)) {
                        return null;
                    }
                    if (in_array($item[ 'id' ], $reportContract::QuarterRatiosList, true)) {
                        return null;
                    }

                    return [
                        'id'       => $item[ 'id' ],
                        'name'     => $item[ 'name' ],
                        'value'    => optional($ratio)->value,
                        'group'    => $item[ 'group' ],
                        'order'    => $item[ 'order' ],
                        'exists'   => $ratio !== null,
                        'ratio_id' => optional($ratio)->id,
                    ];
                }
            )
            ->sortBy('order')
            ->toArray()
        ;

        $ratios = array_filter($ratios);

        $ratiosGroups = [];

        foreach ($ratios as $ratio)
        {
            if(!$ratio['group'])
            {
                $ratio['group'] = trans('report.ratios.group.common');
            }
            if(!isset($ratiosGroups[$ratio['group']]))
            {
                $ratiosGroups[$ratio['group']] = [];
            }
            $ratiosGroups[$ratio['group']][$ratio['id']] = $ratio;
        }

        $ratiosMonth = [];

        foreach ($reportContract::MonthRatiosList as $ratioId) {
            $dateMonth = $date->clone()
                              ->month(1)
                              ->day(1)
            ;
            $month     = 1;

            $dateMonthData = [];

            while ($month <= 12) {
                $dateMonth->month($month);
                $dateMonthStr = $dateMonth->format('Y-m-d');

                $ratiosValue = $this
                    ->query()
                    ->where('report_type_id', $type)
                    ->where('ratio_id', $ratioId)
                    ->where('date', $dateMonthStr)
                    ->where('city_id', $city)
                    ->get()
                    ->last()
                ;

                $name = trans($reportContract::RatioNames[ $ratioId ]);

                $dateMonthData[ $dateMonthStr ] = [
                    'value' => $ratiosValue->value ?? null,
                    'name'  => "{$name} - {$dateMonth->translatedFormat('F')}",
                    'id'    => $ratiosValue->ratio_id ?? $ratioId,
                ];

                $month++;
            }

            $ratiosMonth[ $ratioId ] = $dateMonthData;
        }

        $ratiosQuarter = [];

        foreach ($reportContract::QuarterRatiosList as $ratioId) {
            $dateQuarter = $date->clone()
                                ->day(1)
            ;
            $dateQuarter->lastOfQuarter();
            $quarter = 1;

            $ratiosQuarterData = [];

            while ($quarter <= 5) {
                $dateQuarter->lastOfQuarter();
                $dateQuarterStr= $dateQuarter->day(1)->format('Y-m-d');
                $dateQuarterStrEnd = $dateQuarter->day($dateQuarter->daysInMonth)->format('Y-m-d');
                $dateQuarterStrStart= $dateQuarter->clone()->firstOfQuarter()->format('Y-m-d');

                $ratiosValue = $this
                    ->query()
                    ->where('report_type_id', $type)
                    ->where('ratio_id', $ratioId)
                    ->where('date', '>=',$dateQuarterStrStart)
                    ->where('date', '<=',$dateQuarterStrEnd)
                    ->where('city_id', $city)
                    ->get()
                    ->last()
                ;

                $name = trans($reportContract::RatioNames[ $ratioId ]);

                $ratiosQuarterData[ $dateQuarterStr ] = [
                    'value' => $ratiosValue->value ?? null,
                    'name'  => "{$name} - {$dateQuarter->quarter} кв. {$dateQuarter->format('Y')}",
                    'id'    => $ratiosValue->ratio_id ?? $ratioId,
                ];

                $quarter++;
                $dateQuarter = $dateQuarter->subMonths(4);
            }

            $ratiosQuarter[ $ratioId ] = $ratiosQuarterData;
        }

        return [
            'cityRatios'        => $ratiosGroups,
            'cityRatiosMonth'   => $ratiosMonth,
            'cityRatiosQuarter' => $ratiosQuarter,
        ];

    }


}

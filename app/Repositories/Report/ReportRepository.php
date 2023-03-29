<?php

namespace App\Repositories\Report;

use App\Models\District;
use App\Models\Report\ReportCityRatio;
use App\Models\Report\ReportDistrictRatio;
use App\Repositories\Enums\Reports\Ser\IBusinessStatisticsRatioEnum;
use App\Repositories\Enums\Reports\Prt\IPrtReport;
use App\Repositories\Enums\Reports\IReportTypeEnum;
use App\Repositories\Enums\Reports\Ser\IIndustryRatioReport;
use App\Repositories\Enums\Reports\Ser\IInvestmentReport;
use App\Repositories\Enums\Reports\Ser\ITradeRatioReport;
use Carbon\Carbon;

use Illuminate\Support\Facades\Log;

class ReportRepository implements IReportRepository
{
    final public function getBusinessStatReport(array $attributes): array
    {
        if (!isset($attributes[ 'city_id' ])) {
            $attributes[ 'city_id' ] = '25c728b6-f78e-4fbf-9128-c7bca032874f';
        }
        if (!isset($attributes[ 'date' ])) {
            $attributes[ 'date' ] = Carbon
                ::now()
                ->day(1)
                ->format('Y-m-d')
            ;
        } else {
            $attributes[ 'date' ] = Carbon
                ::createFromFormat('Y-m-d', $attributes[ 'date' ])
                ->day(1)
                ->format('Y-m-d')
            ;
        }

        $currentDate = $attributes[ 'date' ];

        $dates = ReportCityRatio
            ::select('date')
            ->where('report_type_id', IReportTypeEnum::ReportBusinessStatistics)
            ->where('city_id', $attributes[ 'city_id' ])
            ->where('date', '<=', $attributes[ 'date' ])
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('date')
        ;

        $years = [];

        foreach ($dates as $date) {
            $date = Carbon::createFromFormat('Y-m-d', $date);
            if (!in_array($date->year, $years, true)) {
                $years[] = $date->year;
            }
        }
        $lastYears = array_slice($years, -3);

        $result = [
            'registered_month'   => [
                'previous_month_value' => 0,
                'value'                => 0,
                'industry'             => [],
                'sizes'                => [],
            ],
            'new_month'          => [
                'previous_month_value' => 0,
                'value'                => 0,
                'industry'             => [],
                'sizes'                => [],
            ],
            'registeredDistrict' => [],
            'newDistrict'        => [],
            'new_years'          => [],
            'registered_years'   => [],
        ];

        $allRegistered = ReportCityRatio
            ::where('report_type_id', IReportTypeEnum::ReportBusinessStatistics)
            ->where('city_id', $attributes[ 'city_id' ])
            ->where('date', '<=', $currentDate)
            ->where('ratio_id', IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumber)
            ->orderBy('date')
            ->get([ 'value', 'date' ])
            ->last()
        ;

        $previousRegisteredDate = $allRegistered->date
                                  ??
                                  Carbon
                                      ::createFromFormat('Y-m-d', $currentDate)
                                      ->subMonth()
                                      ->format('Y-m-d')
        ;

        $allRegisteredPrevious = ReportCityRatio
            ::where('report_type_id', IReportTypeEnum::ReportBusinessStatistics)
            ->where('city_id', $attributes[ 'city_id' ])
            ->where('date', '<', $previousRegisteredDate)
            ->where('ratio_id', IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumber)
            ->orderBy('date')
            ->get([ 'value', 'date' ])
            ->last()
        ;

        $result[ 'registered_month' ][ 'previous_month_value' ] = $allRegisteredPrevious
            ? (int)$allRegisteredPrevious->value
            : 0;

        $result[ 'registered_month' ][ 'value' ] = $allRegistered
            ? (int)$allRegistered->value
            : 0;

        foreach (IBusinessStatisticsRatioEnum::RegisteredIndustries as $registeredIndustryRatio) {
            $industry = ReportCityRatio
                ::where('report_type_id', IReportTypeEnum::ReportBusinessStatistics)
                ->where('city_id', $attributes[ 'city_id' ])
                ->where('date', $currentDate)
                ->where('ratio_id', $registeredIndustryRatio)
                ->orderBy('date')
                ->get([ 'value', 'date', 'ratio_id' ])
                ->map(
                    function ($item)
                    {
                        $item                = $item->toArray();
                        $itemData            = [];
                        $itemData[ 'value' ] = (int)$item[ 'value' ];
                        $itemData[ 'name' ]  = trans(
                            IBusinessStatisticsRatioEnum::IndustryNames[ $item[ 'ratio_id' ] ]
                        );
                        return $itemData;
                    }
                )
                ->last()
            ;

            if ($industry === null) {
                $industry[ 'value' ] = 0;
                $industry[ 'name' ]  = trans(
                    IBusinessStatisticsRatioEnum::IndustryNames[ $registeredIndustryRatio ]
                );
            }

            $result[ 'registered_month' ][ 'industry' ][] = $industry;
        }

        foreach (IBusinessStatisticsRatioEnum::RegisteredSizes as $registeredSizeRatio) {
            $size = ReportCityRatio
                ::where('report_type_id', IReportTypeEnum::ReportBusinessStatistics)
                ->where('city_id', $attributes[ 'city_id' ])
                ->where('date', $currentDate)
                ->where('ratio_id', $registeredSizeRatio)
                ->orderBy('date')
                ->get([ 'value', 'date', 'ratio_id' ])
                ->map(
                    function ($item)
                    {
                        $item                = $item->toArray();
                        $itemData            = [];
                        $itemData[ 'value' ] = (int)$item[ 'value' ];
                        $itemData[ 'name' ]  = trans(
                            IBusinessStatisticsRatioEnum::SizeNames[ $item[ 'ratio_id' ] ]
                        );
                        return $itemData;
                    }
                )
                ->last()
            ;

            if ($size === null) {
                $size[ 'value' ] = 0;
                $size[ 'name' ]  = trans(
                    IBusinessStatisticsRatioEnum::SizeNames[ $registeredSizeRatio ]
                );
            }

            $result[ 'registered_month' ][ 'sizes' ][] = $size;
        }

        $allOperating = ReportCityRatio
            ::where('report_type_id', IReportTypeEnum::ReportBusinessStatistics)
            ->where('city_id', $attributes[ 'city_id' ])
            ->where('date', '<=', $currentDate)
            ->where('ratio_id', IBusinessStatisticsRatioEnum::OperatingEnterprisesNumber)
            ->orderBy('date')
            ->get([ 'value', 'date' ])
            ->last()
        ;

        $previousOperatingDate = $allOperating->date
                                 ??
                                 Carbon
                                     ::createFromFormat('Y-m-d', $currentDate)
                                     ->subMonth()
                                     ->format('Y-m-d')
        ;

        $allOperatingPrevious = ReportCityRatio
            ::where('report_type_id', IReportTypeEnum::ReportBusinessStatistics)
            ->where('city_id', $attributes[ 'city_id' ])
            ->where('date', '<', $previousOperatingDate)
            ->where('ratio_id', IBusinessStatisticsRatioEnum::OperatingEnterprisesNumber)
            ->orderBy('date')
            ->get([ 'value', 'date' ])
            ->last()
        ;

        $result[ 'new_month' ][ 'previous_month_value' ] = $allOperatingPrevious
            ? (int)$allOperatingPrevious->value
            : 0;

        $result[ 'new_month' ][ 'value' ] = $allOperating
            ? (int)$allOperating->value
            : 0;

        foreach (IBusinessStatisticsRatioEnum::OperatingIndustries as $operatingIndustryRatio) {
            $industry = ReportCityRatio
                ::where('report_type_id', IReportTypeEnum::ReportBusinessStatistics)
                ->where('city_id', $attributes[ 'city_id' ])
                ->where('date', $currentDate)
                ->where('ratio_id', $operatingIndustryRatio)
                ->orderBy('date')
                ->get([ 'value', 'date', 'ratio_id' ])
                ->map(
                    function ($item)
                    {
                        $item                = $item->toArray();
                        $itemData            = [];
                        $itemData[ 'value' ] = (int)$item[ 'value' ];
                        $itemData[ 'name' ]  = trans(
                            IBusinessStatisticsRatioEnum::IndustryNames[ $item[ 'ratio_id' ] ]
                        );
                        return $itemData;
                    }
                )
                ->last()
            ;

            if ($industry === null) {
                $industry[ 'value' ] = 0;
                $industry[ 'name' ]  = trans(
                    IBusinessStatisticsRatioEnum::IndustryNames[ $operatingIndustryRatio ]
                );
            }

            $result[ 'new_month' ][ 'industry' ][] = $industry;
        }

        foreach (IBusinessStatisticsRatioEnum::OperatingSizes as $operatingSizeRatio) {
            $size = ReportCityRatio
                ::where('report_type_id', IReportTypeEnum::ReportBusinessStatistics)
                ->where('city_id', $attributes[ 'city_id' ])
                ->where('date', $currentDate)
                ->where('ratio_id', $operatingSizeRatio)
                ->orderBy('date')
                ->get([ 'value', 'date', 'ratio_id' ])
                ->map(
                    function ($item)
                    {
                        $item                = $item->toArray();
                        $itemData            = [];
                        $itemData[ 'value' ] = (int)$item[ 'value' ];
                        $itemData[ 'name' ]  = trans(
                            IBusinessStatisticsRatioEnum::SizeNames[ $item[ 'ratio_id' ] ]
                        );
                        return $itemData;
                    }
                )
                ->last()
            ;

            if ($size === null) {
                $size[ 'value' ] = 0;
                $size[ 'name' ]  = trans(
                    IBusinessStatisticsRatioEnum::SizeNames[ $operatingSizeRatio ]
                );
            }

            $result[ 'new_month' ][ 'sizes' ][] = $size;
        }

        foreach ($lastYears as $year) {
            $dateStart    = Carbon::createFromFormat('Y-m-d', "{$year}-01-01");
            $lastMonth    = Carbon::createFromFormat('Y-m-d', $currentDate)->month;
            $dateEnd      = $dateStart
                ->clone()
                ->month($lastMonth)
            ;
            $dateEnd      = $dateEnd->day($dateEnd->daysInMonth);
            $dateStartStr = $dateStart->format('Y-m-d');
            $dateEndStr   = $dateEnd->format('Y-m-d');

            $allRegisteredYear = ReportCityRatio
                ::where('report_type_id', IReportTypeEnum::ReportBusinessStatistics)
                ->where('city_id', $attributes[ 'city_id' ])
                ->where('date', '>=', $dateStartStr)
                ->where('date', '<=', $dateEndStr)
                ->where('ratio_id', IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumber)
                ->orderBy('date')
                ->get([ 'value', 'date' ])
                ->last()
            ;

            $result[ 'registered_years' ][] = [
                'value' => $allRegisteredYear
                    ? (int)$allRegisteredYear->value
                    : 0,
                'year'  => $year,
            ];

        }

        foreach ($lastYears as $year) {
            $dateStart    = Carbon::createFromFormat('Y-m-d', "{$year}-01-01");
            $lastMonth    = Carbon::createFromFormat('Y-m-d', $currentDate)->month;
            $dateEnd      = $dateStart
                ->clone()
                ->month($lastMonth)
            ;
            $dateEnd      = $dateEnd->day($dateEnd->daysInMonth);
            $dateStartStr = $dateStart->format('Y-m-d');
            $dateEndStr   = $dateEnd->format('Y-m-d');

            $allOperatingYear = ReportCityRatio
                ::where('report_type_id', IReportTypeEnum::ReportBusinessStatistics)
                ->where('city_id', $attributes[ 'city_id' ])
                ->where('date', '>=', $dateStartStr)
                ->where('date', '<=', $dateEndStr)
                ->where('ratio_id', IBusinessStatisticsRatioEnum::OperatingEnterprisesNumber)
                ->orderBy('date')
                ->get([ 'value', 'date' ])
                ->last()
            ;

            $result[ 'new_years' ][] = [
                'value' => $allOperatingYear
                    ? (int)$allOperatingYear->value
                    : 0,
                'year'  => $year,
            ];

        }

        $operating = ReportDistrictRatio
            ::with('district')
            ->where('report_type_id', IReportTypeEnum::ReportBusinessStatistics)
            ->where('date', $currentDate)
            ->where('ratio_id', IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberDistrict)
            ->get()
            ->map(
                function ($item)
                {
                    return [
                        'name'  => optional($item->district)->name,
                        'value' => $item->value,
                    ];
                }
            )
            ->toArray()
        ;

        $registered = ReportDistrictRatio
            ::with('district')
            ->where('report_type_id', IReportTypeEnum::ReportBusinessStatistics)
            ->where('date', $currentDate)
            ->where('ratio_id', IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberDistrict)
            ->get()
            ->map(
                function ($item)
                {
                    return [
                        'name'  => optional($item->district)->name,
                        'value' => $item->value,
                    ];
                }
            )
            ->toArray()
        ;

        $result[ 'newDistrict' ]        = $operating;
        $result[ 'registeredDistrict' ] = $registered;

        return $result;
    }

    final public function getInvestmentsReport(array $attributes): array
    {
        if (!isset($attributes[ 'city_id' ])) {
            $attributes[ 'city_id' ] = '25c728b6-f78e-4fbf-9128-c7bca032874f';
        }
        if (!isset($attributes[ 'date' ])) {
            $attributes[ 'date' ] = Carbon
                ::now()
                ->day(1)
                ->format('Y-m-d')
            ;
        } else {
            $attributes[ 'date' ] = Carbon
                ::createFromFormat('Y-m-d', $attributes[ 'date' ])
                ->day(1)
                ->format('Y-m-d')
            ;
        }

        $currentDate = $attributes[ 'date' ];

        $dates = ReportCityRatio
            ::select('date')
            ->where('report_type_id', IReportTypeEnum::ReportBusinessStatistics)
            ->where('city_id', $attributes[ 'city_id' ])
            ->where('date', '<=', $attributes[ 'date' ])
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('date')
        ;

        $years = [];

        foreach ($dates as $date) {
            $date = Carbon::createFromFormat('Y-m-d', $date);
            if (!in_array($date->year, $years, true)) {
                $years[] = $date->year;
            }
        }
        $districts       = District::all();
        $dateStartGlobal = Carbon::createFromFormat('Y-m-d', $currentDate)
                                 ->month(1)
                                 ->day(1)
        ;
        $dateEndGlobal   = $dateStartGlobal
            ->clone()
            ->month(12)
        ;
        $dateEndGlobal   = $dateEndGlobal->day($dateEndGlobal->daysInMonth);

        $dateStartGlobalStr = $dateStartGlobal->format('Y-m-d');
        $dateEndGlobalStr   = $dateEndGlobal->format('Y-m-d');

        $result = [
            'month' => [
                'invest_value'      => 0,
                'IFO'               => 0,
                'internal_invest'   => 0,
                'external_invest'   => 0,
                'self_invest'       => 0,
                'loan_invest'       => 0,
                'government_invest' => 0,
                'By_months'         => [],
                'Invest_Types'      => [],
                'Sizes'             => [],
                'Districts'         => [],
                'Industry'          => [],
            ],
        ];

        foreach (IInvestmentReport::PlainRatios as $plainRatioId => $name) {
            $plainRatio = ReportCityRatio
                ::where('report_type_id', IReportTypeEnum::ReportTypeInvestments)
                ->where('city_id', $attributes[ 'city_id' ])
                ->where('date', '<=', $currentDate)
                ->where('ratio_id', $plainRatioId)
                ->orderBy('date')
                ->get([ 'value', 'date' ])
                ->last()
            ;

            if ($plainRatio) {
                $result[ 'month' ][ $name ] = (float)$plainRatio->value;
            } else {
                $result[ 'month' ][ $name ] = 0;
            }
        }

        $governmentLocal = ReportCityRatio
            ::where('report_type_id', IReportTypeEnum::ReportTypeInvestments)
            ->where('city_id', $attributes[ 'city_id' ])
            ->where('date', '<=', $currentDate)
            ->where('ratio_id', IInvestmentReport::InvestmentGovernmentLocal)
            ->orderBy('date')
            ->get([ 'value', 'date' ])
            ->last()
        ;

        $governmentRepublic = ReportCityRatio
            ::where('report_type_id', IReportTypeEnum::ReportTypeInvestments)
            ->where('city_id', $attributes[ 'city_id' ])
            ->where('date', $governmentLocal->date)
            ->where('ratio_id', IInvestmentReport::InvestmentGovernmentRepublic)
            ->orderBy('date')
            ->get([ 'value', 'date' ])
            ->last()
        ;

        Log::info($dateStartGlobalStr);
        Log::info($dateEndGlobalStr);
        $governmentInvest = 0;
        $governmentInvest += $governmentLocal
            ? (float)$governmentLocal->value
            : 0;
        $governmentInvest += $governmentRepublic
            ? (float)$governmentRepublic->value
            : 0;

        $result[ 'month' ][ 'government_invest' ] = $governmentInvest;

        $month = 1;

        while ($month <= 12) {
            $monthDateStart    = $dateStartGlobal
                ->clone()
                ->month($month)
            ;
            $monthDateStartStr = $monthDateStart
                ->format('Y-m-d');

            $dynamic = ReportCityRatio
                ::where('report_type_id', IReportTypeEnum::ReportTypeInvestments)
                ->where('city_id', $attributes[ 'city_id' ])
                ->where('date', $monthDateStartStr)
                ->where('ratio_id', IInvestmentReport::InvestmentIfoDynamic)
                ->orderBy('date')
                ->get([ 'value', 'date' ])
                ->map(
                    function ($item)
                    {
                        $date = Carbon::createFromFormat('Y-m-d', $item->date);
                        return [
                            'name'  => $date->translatedFormat('F'),
                            'value' => (float)$item->value,
                        ];
                    }
                )
                ->last()
            ;

            if (!$dynamic) {
                $dynamic = [
                    'name'  => $monthDateStart->translatedFormat('F'),
                    'value' => 0,
                    'order' => $month,
                ];
            }else{
                $dynamic['order'] = $month;
            }

            $result[ 'month' ][ 'By_months' ][] = $dynamic;
            $month++;
        }

        foreach (IInvestmentReport::InvestmentVolumeByActivityIds as $ratio_id => $activityId) {
            $activity = ReportCityRatio
                ::where('report_type_id', IReportTypeEnum::ReportTypeInvestments)
                ->where('city_id', $attributes[ 'city_id' ])
                ->where('date', $currentDate)
                ->where('ratio_id', $ratio_id)
                ->orderBy('date')
                ->get([ 'value', 'date', 'ratio_id' ])
                ->map(
                    function ($item)
                    {
                        $item                = $item->toArray();
                        $itemData            = [];
                        $itemData[ 'value' ] = (float)$item[ 'value' ];
                        $itemData[ 'name' ]  = trans(
                            IInvestmentReport::InvestmentVolumeByActivityNames[ $item[ 'ratio_id' ] ]
                        );
                        return $itemData;
                    }
                )
                ->last()
            ;

            if (!$activity) {
                $activity = [
                    'name'  => trans(IInvestmentReport::InvestmentVolumeByActivityNames[ $ratio_id ]),
                    'value' => 0,
                ];
            }

            $result[ 'month' ][ 'Industry' ][] = $activity;
        }

        $lastCostTypeDates = $this->getLastRatioDate(
            $currentDate,
            IReportTypeEnum::ReportTypeInvestments,
            $attributes[ 'city_id' ],
            array_keys(IInvestmentReport::InvestmentByCostTypeIds)
        );

        $lastCostTypeDate      = Carbon::createFromFormat('Y-m-d', $lastCostTypeDates);
        $lastCostTypeDateStart = $lastCostTypeDate
            ->clone()
            ->month(1)
            ->day(1)
            ->format('Y-m-d')
        ;
        $lastCostTypeDateEnd   = $lastCostTypeDate
            ->clone()
            ->month(12)
        ;
        $lastCostTypeDateEnd   = $lastCostTypeDateEnd
            ->day($lastCostTypeDate->daysInMonth)
            ->format('Y-m-d')
        ;

        foreach (IInvestmentReport::InvestmentByCostTypeIds as $ratio_id => $costTypeId) {
            $cost = ReportCityRatio
                ::where('report_type_id', IReportTypeEnum::ReportTypeInvestments)
                ->where('city_id', $attributes[ 'city_id' ])
                ->where('date', '>=', $lastCostTypeDateStart)
                ->where('date', '<=', $lastCostTypeDateEnd)
                ->where('ratio_id', $ratio_id)
                ->orderBy('date')
                ->get([ 'value', 'date', 'ratio_id' ])
                ->map(
                    function ($item)
                    {
                        $item                = $item->toArray();
                        $itemData            = [];
                        $itemData[ 'value' ] = (float)$item[ 'value' ];
                        $itemData[ 'name' ]  = trans(
                            IInvestmentReport::InvestmentByCostTypeNames[ $item[ 'ratio_id' ] ]
                        );
                        return $itemData;
                    }
                )
                ->last()
            ;

            if (!$cost) {
                $cost = [
                    'name'  => trans(IInvestmentReport::InvestmentByCostTypeNames[ $ratio_id ]),
                    'value' => 0,
                ];
            }

            $result[ 'month' ][ 'Invest_Types' ][] = $cost;
        }

        $investmentBySizeOfEnterprisesDate = $this->getLastRatioDate(
            $currentDate,
            IReportTypeEnum::ReportTypeInvestments,
            $attributes[ 'city_id' ],
            array_keys(IInvestmentReport::InvestmentByCostTypeIds)
        );

        foreach (IInvestmentReport::InvestmentBySizeOfEnterprisesIds as $ratio_id => $activityId) {
            $size = ReportCityRatio
                ::where('report_type_id', IReportTypeEnum::ReportTypeInvestments)
                ->where('city_id', $attributes[ 'city_id' ])
                ->where('date', $investmentBySizeOfEnterprisesDate)
                ->where('ratio_id', $ratio_id)
                ->orderBy('date')
                ->get([ 'value', 'date', 'ratio_id' ])
                ->map(
                    function ($item)
                    {
                        $item                = $item->toArray();
                        $itemData            = [];
                        $itemData[ 'value' ] = (float)$item[ 'value' ];
                        $itemData[ 'name' ]  = trans(
                            IInvestmentReport::InvestmentBySizeOfEnterprisesNames[ $item[ 'ratio_id' ] ]
                        );
                        return $itemData;
                    }
                )
                ->last()
            ;

            if (!$size) {
                $size = [
                    'name'  => trans(IInvestmentReport::InvestmentBySizeOfEnterprisesNames[ $ratio_id ]),
                    'value' => 0,
                ];
            }

            $result[ 'month' ][ 'Sizes' ][] = $size;
        }

        $investmentDate = ReportDistrictRatio
            ::where('report_type_id', IReportTypeEnum::ReportTypeInvestments)
            ->where('city_id', $attributes[ 'city_id' ])
            ->where('ratio_id', IInvestmentReport::InvestmentByDistrict)
            ->whereIn('district_id', $districts->pluck('id'))
            ->where('value', '!=', 0)
            ->where('date', '<=', $currentDate)
            ->max('date')
        ;

        foreach ($districts as $district) {
            $investment = ReportDistrictRatio
                ::where('report_type_id', IReportTypeEnum::ReportTypeInvestments)
                ->where('city_id', $attributes[ 'city_id' ])
                ->where('date', $investmentDate)
                ->where('ratio_id', IInvestmentReport::InvestmentByDistrict)
                ->where('district_id', $district->id)
                ->orderBy('date')
                ->get([ 'value', 'date', 'ratio_id' ])
                ->map(
                    function ($item) use ($district)
                    {
                        return [
                            'value' => (float)$item->value,
                            'name'  => optional($district)->name,
                        ];
                    }
                )
                ->last()
            ;

            if (!$investment) {
                $investment = [
                    'name'  => optional($district)->name,
                    'value' => 0,
                ];
            }

            $result[ 'month' ][ 'Districts' ][] = $investment;

        }

        return [ $result ];
    }

    final public function getIndustryReport(array $attributes): array
    {
        if (!isset($attributes[ 'city_id' ])) {
            $attributes[ 'city_id' ] = '25c728b6-f78e-4fbf-9128-c7bca032874f';
        }
        if (!isset($attributes[ 'date' ])) {
            $attributes[ 'date' ] = Carbon
                ::now()
                ->day(1)
                ->format('Y-m-d')
            ;
        } else {
            $attributes[ 'date' ] = Carbon
                ::createFromFormat('Y-m-d', $attributes[ 'date' ])
                ->day(1)
                ->format('Y-m-d')
            ;
        }

        $currentDate = $attributes[ 'date' ];

        $dates = ReportCityRatio
            ::select('date')
            ->where('report_type_id', IReportTypeEnum::ReportTypeIndustry)
            ->where('city_id', $attributes[ 'city_id' ])
            ->where('date', '<=', $attributes[ 'date' ])
            ->whereIn(
                'ratio_id',
                [
                    IIndustryRatioReport::ManufacturingIndustryOutput,
                    IIndustryRatioReport::IndustrialProductionVolume,
                ]
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('date')
        ;

        $years = [];

        foreach ($dates as $date) {
            $date = Carbon::createFromFormat('Y-m-d', $date);
            if (!in_array($date->year, $years, true)) {
                $years[] = $date->year;
            }
        }

        $lastYears = array_slice($years, -3);

        $result = [
            'month' => [
                'enterpriseNumber'                        => 0,
                'employedCount'                           => 0,
                'averageSalary'                           => 0,
                'tax'                                     => 0,
                'manufacturingIndustryOutput'             => 0,
                'industrialProductionVolume'              => 0,
                'physicalVolumeIndexIndustrialProduction' => 0,
                'physicalVolumeIndexManufacturing'        => 0,
                'industrialProductionVolumeIndustry'      => [],
                'manufacturingIndustryStructure'          => [],
            ],
            'years' => [],
        ];

        foreach (IIndustryRatioReport::PlainRatios as $plainRatioId => $name) {
            $plainRatio = ReportCityRatio
                ::where('report_type_id', IReportTypeEnum::ReportTypeIndustry)
                ->where('city_id', $attributes[ 'city_id' ])
                ->where('date', '<=', $currentDate)
                ->where('ratio_id', $plainRatioId)
                ->orderBy('date')
                ->get([ 'value', 'date' ])
                ->last()
            ;

            if ($plainRatio) {
                $result[ 'month' ][ $name ] = (float)$plainRatio->value;
            } else {
                $result[ 'month' ][ $name ] = 0;
            }
        }

        foreach (IIndustryRatioReport::QuarterRatios as $quarterRatioId => $name) {
            $quarterDateEnd = Carbon::createFromFormat('Y-m-d', $currentDate)
                                    ->lastOfQuarter()
            ;

            $quarterDateStart = Carbon::createFromFormat('Y-m-d', $currentDate)
                                      ->lastOfQuarter()
                                      ->subMonths(2)
            ;

            $quarterRatio = ReportCityRatio
                ::where('report_type_id', IReportTypeEnum::ReportTypeIndustry)
                ->where('city_id', $attributes[ 'city_id' ])
                ->where('date', '>=', $quarterDateStart->format('Y-m-d'))
                ->where('date', '<=', $quarterDateEnd->format('Y-m-d'))
                ->where('ratio_id', $quarterRatioId)
                ->orderBy('date')
                ->get([ 'value', 'date' ])
                ->last()
            ;

            if ($quarterRatio === null) {
                $quarterRatioDateLastStr = ReportCityRatio
                    ::where('report_type_id', IReportTypeEnum::ReportTypeIndustry)
                    ->where('city_id', $attributes[ 'city_id' ])
                    ->where('ratio_id', $quarterRatioId)
                    ->max('date');

                $quarterRatioDateLast = $quarterRatioDateLastStr
                    ? Carbon::createFromFormat('Y-m-d', $quarterRatioDateLastStr)
                    : Carbon::createFromFormat('Y-m-d', $currentDate);


                $quarterDateEnd = $quarterRatioDateLast->clone()
                                                       ->subMonths(2)
                                                       ->lastOfQuarter()
                ;

                $quarterDateStart = $quarterRatioDateLast->clone()
                                                         ->subMonths(2)
                                                         ->day(1)
                ;

                $quarterRatio = ReportCityRatio
                    ::where('report_type_id', IReportTypeEnum::ReportTypeIndustry)
                    ->where('city_id', $attributes[ 'city_id' ])
                    ->where('date', '>=', $quarterDateStart->format('Y-m-d'))
                    ->where('date', '<=', $quarterDateEnd->format('Y-m-d'))
                    ->where('ratio_id', $quarterRatioId)
                    ->orderBy('date')
                    ->get([ 'value', 'date' ])
                    ->last()
                ;

            }

            if ($quarterRatio) {
                $result[ 'month' ][ $name ] = (float)$quarterRatio->value;
            } else {
                $result[ 'month' ][ $name ] = 0;
            }
        }

        $industrialProductionVolumeIndustryDate = ReportCityRatio
            ::where('report_type_id', IReportTypeEnum::ReportTypeIndustry)
            ->where('city_id', $attributes[ 'city_id' ])
            ->whereIn('ratio_id', array_keys(IIndustryRatioReport::IndustrialProductionVolumeIndustryIds))
            ->max('date')
        ;

        foreach (IIndustryRatioReport::IndustrialProductionVolumeIndustryIds as $ratioIndustryId => $industryType) {
            $industry = ReportCityRatio
                ::where('report_type_id', IReportTypeEnum::ReportTypeIndustry)
                ->where('city_id', $attributes[ 'city_id' ])
                ->where('date', $industrialProductionVolumeIndustryDate)
                ->where('ratio_id', $ratioIndustryId)
                ->orderBy('date')
                ->get([ 'value', 'date', 'ratio_id' ])
                ->map(
                    function ($item)
                    {
                        $item                = $item->toArray();
                        $itemData            = [];
                        $itemData[ 'value' ] = (float)$item[ 'value' ];
                        $itemData[ 'name' ]  = trans(
                            IIndustryRatioReport::IndustrialProductionVolumeIndustryNames[ $item[ 'ratio_id' ] ]
                        );
                        return $itemData;
                    }
                )
                ->last()
            ;

            if (!$industry) {
                $industry = [
                    'name'  => trans(IIndustryRatioReport::IndustrialProductionVolumeIndustryNames[ $ratioIndustryId ]),
                    'value' => 0,
                ];
            }

            $result[ 'month' ][ 'industrialProductionVolumeIndustry' ][] = $industry;
        }

        foreach (IIndustryRatioReport::ManufacturingIndustryStructureIds as $ratioStructureId => $structureType) {
            $structure = ReportCityRatio
                ::where('report_type_id', IReportTypeEnum::ReportTypeIndustry)
                ->where('city_id', $attributes[ 'city_id' ])
                ->where('date', $currentDate)
                ->where('ratio_id', $ratioStructureId)
                ->orderBy('date')
                ->get([ 'value', 'date', 'ratio_id' ])
                ->map(
                    function ($item)
                    {
                        $item                = $item->toArray();
                        $itemData            = [];
                        $itemData[ 'value' ] = (float)$item[ 'value' ];
                        $itemData[ 'name' ]  = trans(
                            IIndustryRatioReport::ManufacturingIndustryStructureNames[ $item[ 'ratio_id' ] ]
                        );
                        return $itemData;
                    }
                )
                ->last()
            ;

            if (!$structure) {
                $structure = [
                    'name'  => trans(IIndustryRatioReport::ManufacturingIndustryStructureNames[ $ratioStructureId ]),
                    'value' => 0,
                ];
            }

            $result[ 'month' ][ 'manufacturingIndustryStructure' ][] = $structure;
        }

        foreach ($lastYears as $year) {
            $dateStart = Carbon::createFromFormat('Y-m-d', "{$year}-01-01");
            $lastMonth = Carbon::createFromFormat('Y-m-d', $currentDate)->month;
            $dateEnd   = $dateStart
                ->clone()
                ->month($lastMonth)
            ;
            $dateEnd   = $dateEnd->day($dateEnd->daysInMonth);

            $dateStartStr = $dateStart->format('Y-m-d');
            $dateEndStr   = $dateEnd->format('Y-m-d');

            $manufacturingIndustryOutput = ReportCityRatio
                ::where('report_type_id', IReportTypeEnum::ReportTypeIndustry)
                ->where('city_id', $attributes[ 'city_id' ])
                ->where('date', '>=', $dateStartStr)
                ->where('date', '<=', $dateEndStr)
                ->where('ratio_id', IIndustryRatioReport::ManufacturingIndustryOutput)
                ->orderBy('date')
                ->get([ 'value', 'date' ])
                ->reduce(
                    function ($acc, $item)
                    {
                        $value = (float)$item->value;
                        return $acc + $value;
                    },
                    0
                )
            ;

            $industrialProductionVolume = ReportCityRatio
                ::where('report_type_id', IReportTypeEnum::ReportTypeIndustry)
                ->where('city_id', $attributes[ 'city_id' ])
                ->where('date', '>=', $dateStartStr)
                ->where('date', '<=', $dateEndStr)
                ->where('ratio_id', IIndustryRatioReport::IndustrialProductionVolume)
                ->orderBy('date')
                ->get([ 'value', 'date' ])
                ->reduce(
                    function ($acc, $item)
                    {
                        $value = (float)$item->value;
                        return $acc + $value;
                    },
                    0
                )
            ;

            $yearData = [
                'year'                      => $year,
                'IndustrialProductionValue' => $industrialProductionVolume
                    ? (float)$industrialProductionVolume
                    : 0,
                'ManufacturingValue'        => $manufacturingIndustryOutput
                    ? (float)$manufacturingIndustryOutput
                    : 0,
            ];

            $result[ 'years' ][] = $yearData;
        }

        return [ $result ];
    }

    final public function getTradeReport(array $attributes): array
    {
        if (!isset($attributes[ 'city_id' ])) {
            $attributes[ 'city_id' ] = '25c728b6-f78e-4fbf-9128-c7bca032874f';
        }
        if (!isset($attributes[ 'date' ])) {
            $attributes[ 'date' ] = Carbon
                ::now()
                ->day(1)
                ->format('Y-m-d')
            ;
        } else {
            $attributes[ 'date' ] = Carbon
                ::createFromFormat('Y-m-d', $attributes[ 'date' ])
                ->day(1)
                ->format('Y-m-d')
            ;
        }

        $currentDate = $attributes[ 'date' ];

        $dates = ReportCityRatio
            ::select('date')
            ->where('report_type_id', IReportTypeEnum::ReportTypeIndustry)
            ->where('city_id', $attributes[ 'city_id' ])
            ->where('date', '<=', $attributes[ 'date' ])
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('date')
        ;

        $years = [];

        foreach ($dates as $date) {
            $date = Carbon::createFromFormat('Y-m-d', $date);
            if (!in_array($date->year, $years, true)) {
                $years[] = $date->year;
            }
        }

        $lastYears       = array_slice($years, -3);
        $districts       = District::all();
        $dateStartGlobal = Carbon::createFromFormat('Y-m-d', $currentDate)
                                 ->month(1)
                                 ->day(1)
        ;
        $dateEndGlobal   = $dateStartGlobal
            ->clone()
            ->month(12)
        ;
        $dateEndGlobal   = $dateEndGlobal->day($dateEndGlobal->daysInMonth);

        $dateStartGlobalStr = $dateStartGlobal->format('Y-m-d');
        $dateEndGlobalStr   = $dateEndGlobal->format('Y-m-d');

        $result = [
            'month' => [
                'enterpriseNumber'                  => 0,
                'employedCount'                     => 0,
                'averageSalary'                     => 0,
                'tax'                               => 0,
                'tradeWholesaleTurnover'            => 0,
                'tradeWholesalePhysicalVolumeIndex' => 0,
                'tradeRetailTurnover'               => 0,
                'tradeRetailPhysicalVolumeIndex'    => 0,
                'tradeWholesaleStructure'           => [],
                'tradeWholesaleTurnoverByDistrict'  => [],
                'tradeRetailStructure'              => [],
                'tradeRetailTurnoverByDistrict'     => [],
            ],
            'years' => [],
        ];

        foreach (ITradeRatioReport::PlainRatios as $plainRatioId => $name) {
            $plainRatio = ReportCityRatio
                ::where('report_type_id', IReportTypeEnum::ReportTypeTrade)
                ->where('city_id', $attributes[ 'city_id' ])
                ->where('date', '<=', $currentDate)
                ->where('ratio_id', $plainRatioId)
                ->orderBy('date')
                ->get([ 'value', 'date' ])
                ->last()
            ;

            if ($plainRatio) {
                $result[ 'month' ][ $name ] = (float)$plainRatio->value;
            } else {
                $result[ 'month' ][ $name ] = 0;
            }

        }

        foreach (ITradeRatioReport::QuarterRatios as $quarterRatioId => $name) {
            $quarterDateEnd = Carbon::createFromFormat('Y-m-d', $currentDate)
                                    ->lastOfQuarter()
            ;

            $quarterDateStart = Carbon::createFromFormat('Y-m-d', $currentDate)
                                      ->lastOfQuarter()
                                      ->subMonths(2)
            ;

            $quarterRatio = ReportCityRatio
                ::where('report_type_id', IReportTypeEnum::ReportTypeTrade)
                ->where('city_id', $attributes[ 'city_id' ])
                ->where('date', '>=', $quarterDateStart->format('Y-m-d'))
                ->where('date', '<=', $quarterDateEnd->format('Y-m-d'))
                ->where('ratio_id', $quarterRatioId)
                ->orderBy('date')
                ->get([ 'value', 'date' ])
                ->last()
            ;

            if ($quarterRatio === null) {
                $quarterDateEnd = $quarterDateStart->clone()
                                                   ->subMonths(2)
                                                   ->lastOfQuarter()
                ;

                $quarterDateStart = $quarterDateEnd->clone()
                                                   ->subMonths(2)
                                                   ->day(1)
                ;

                $quarterRatio = ReportCityRatio
                    ::where('report_type_id', IReportTypeEnum::ReportTypeTrade)
                    ->where('city_id', $attributes[ 'city_id' ])
                    ->where('date', '>=', $quarterDateStart->format('Y-m-d'))
                    ->where('date', '<=', $quarterDateEnd->format('Y-m-d'))
                    ->where('ratio_id', $quarterRatioId)
                    ->orderBy('date')
                    ->get([ 'value', 'date' ])
                    ->last()
                ;

            }

            if ($quarterRatio) {
                $result[ 'month' ][ $name ] = (float)$quarterRatio->value;
            } else {
                $result[ 'month' ][ $name ] = 0;
            }
        }

        $lastWholesaleDate = $currentDate;

        foreach (ITradeRatioReport::TradeWholesaleStructureIds as $ratio_id => $industryType) {
            $industry = ReportCityRatio
                ::where('report_type_id', IReportTypeEnum::ReportTypeTrade)
                ->where('city_id', $attributes[ 'city_id' ])
                ->where('date', '<=', $lastWholesaleDate)
                ->where('value', '>', 0)
                ->where('ratio_id', $ratio_id)
                ->orderBy('date')
                ->get([ 'value', 'date', 'ratio_id' ])
            ;

            $lastWholesaleDate = $industry->last()
                ? $industry->last()->date
                : $currentDate;

            $industry = $industry->map(
                function ($item)
                {
                    $item                = $item->toArray();
                    $itemData            = [];
                    $itemData[ 'value' ] = (float)$item[ 'value' ];
                    $itemData[ 'name' ]  = trans(
                        ITradeRatioReport::TradeStructureNames[ $item[ 'ratio_id' ] ]
                    );
                    return $itemData;
                }
            )
                                 ->last()
            ;

            if (!$industry) {
                $industry = [
                    'name'  => trans(ITradeRatioReport::TradeStructureNames[ $ratio_id ]),
                    'value' => 0,
                ];
            }

            $result[ 'month' ][ 'tradeWholesaleStructure' ][] = $industry;
        }

        $lastRetailDate = $currentDate;

        foreach (ITradeRatioReport::TradeRetailStructureIds as $ratio_id => $industryType) {
            $industry = ReportCityRatio
                ::where('report_type_id', IReportTypeEnum::ReportTypeTrade)
                ->where('city_id', $attributes[ 'city_id' ])
                ->where('date', '<=', $lastRetailDate)
                ->where('value', '>', 0)
                ->where('ratio_id', $ratio_id)
                ->orderBy('date')
                ->get([ 'value', 'date', 'ratio_id' ])
            ;

            $lastRetailDate = $industry->last()
                ? $industry->last()->date
                : $currentDate;

            $industry = $industry
                ->map(
                    function ($item)
                    {
                        $item                = $item->toArray();
                        $itemData            = [];
                        $itemData[ 'value' ] = (float)$item[ 'value' ];
                        $itemData[ 'name' ]  = trans(
                            ITradeRatioReport::TradeStructureNames[ $item[ 'ratio_id' ] ]
                        );
                        return $itemData;
                    }
                )
                ->last()
            ;

            if (!$industry) {
                $industry = [
                    'name'  => trans(ITradeRatioReport::TradeStructureNames[ $ratio_id ]),
                    'value' => 0,
                ];
            }

            $result[ 'month' ][ 'tradeRetailStructure' ][] = $industry;
        }

        $tradeWholesaleTurnoverByDistrictDate = ReportDistrictRatio
            ::where('report_type_id', IReportTypeEnum::ReportTypeTrade)
            ->where('city_id', $attributes[ 'city_id' ])
            ->where('ratio_id', ITradeRatioReport::TradeWholesaleTurnoverByDistrict)
            ->whereIn('district_id', $districts->pluck('id'))
            ->where('value', '!=', 0)
            ->where('date', '<=', $currentDate)
            ->max('date')
        ;

        $tradeRetailTurnoverByDistrictDate = ReportDistrictRatio
            ::where('report_type_id', IReportTypeEnum::ReportTypeTrade)
            ->where('city_id', $attributes[ 'city_id' ])
            ->where('ratio_id', ITradeRatioReport::TradeRetailTurnoverByDistrict)
            ->whereIn('district_id', $districts->pluck('id'))
            ->where('value', '!=', 0)
            ->where('date', '<=', $currentDate)
            ->max('date')
        ;

        foreach ($districts as $district) {
            $wholesale = ReportDistrictRatio
                ::where('report_type_id', IReportTypeEnum::ReportTypeTrade)
                ->where('city_id', $attributes[ 'city_id' ])
                ->where('date', $tradeWholesaleTurnoverByDistrictDate)
                ->where('ratio_id', ITradeRatioReport::TradeWholesaleTurnoverByDistrict)
                ->where('district_id', $district->id)
                ->orderBy('date')
                ->get([ 'value', 'date', 'ratio_id' ])
                ->map(
                    function ($item) use ($district)
                    {
                        return [
                            'value' => (float)$item->value,
                            'name'  => optional($district)->name,
                        ];
                    }
                )
                ->last()
            ;

            if (!$wholesale) {
                $wholesale = [
                    'name'  => optional($district)->name,
                    'value' => 0,
                ];
            }

            $retail = ReportDistrictRatio
                ::where('report_type_id', IReportTypeEnum::ReportTypeTrade)
                ->where('city_id', $attributes[ 'city_id' ])
                ->where('date', $tradeRetailTurnoverByDistrictDate)
                ->where('ratio_id', ITradeRatioReport::TradeRetailTurnoverByDistrict)
                ->where('district_id', $district->id)
                ->orderBy('date')
                ->get([ 'value', 'date', 'ratio_id' ])
                ->map(
                    function ($item) use ($district)
                    {
                        return [
                            'value' => (float)$item->value,
                            'name'  => optional($district)->name,
                        ];
                    }
                )
                ->last()
            ;

            if (!$retail) {
                $retail = [
                    'name'  => optional($district)->name,
                    'value' => 0,
                ];
            }

            $result[ 'month' ][ 'tradeWholesaleTurnoverByDistrict' ][] = $wholesale;
            $result[ 'month' ][ 'tradeRetailTurnoverByDistrict' ][]    = $retail;

        }

        foreach ($lastYears as $year) {
            $yearRow = [
                'year'         => $year,
                'retail_value' => 0,
                'whole_value'  => 0,
            ];

            $dateStart = Carbon::createFromFormat('Y-m-d', "{$year}-01-01");
            $lastMonth = Carbon::createFromFormat('Y-m-d', $currentDate)->month;
            $dateEnd   = $dateStart
                ->clone()
                ->month($lastMonth)
            ;
            $dateEnd   = $dateEnd->day($dateEnd->daysInMonth);

            $dateStartStr = $dateStart->format('Y-m-d');
            $dateEndStr   = $dateEnd->format('Y-m-d');

            $retail = ReportCityRatio
                ::where('report_type_id', IReportTypeEnum::ReportTypeTrade)
                ->where('city_id', $attributes[ 'city_id' ])
                ->where('date', '>=', $dateStartStr)
                ->where('date', '<=', $dateEndStr)
                ->where('ratio_id', ITradeRatioReport::TradeRetailTurnoverByYears)
                ->get('value')
                ->last()
            ;

            $yearRow[ 'retail_value' ] = $retail
                ? (float)$retail->value
                : 0;

            $wholesale = ReportCityRatio
                ::where('report_type_id', IReportTypeEnum::ReportTypeTrade)
                ->where('city_id', $attributes[ 'city_id' ])
                ->where('date', '>=', $dateStartStr)
                ->where('date', '<=', $dateEndStr)
                ->where('ratio_id', ITradeRatioReport::TradeWholesaleTurnoverByYears)
                ->get('value')
                ->last()
            ;

            $yearRow[ 'whole_value' ] = $wholesale
                ? (float)$wholesale->value
                : 0;

            $result[ 'years' ][] = $yearRow;
        }

        return $result;
    }

    final public function getPrtReport(array $attributes): array
    {
        if (!isset($attributes[ 'city_id' ])) {
            $attributes[ 'city_id' ] = '25c728b6-f78e-4fbf-9128-c7bca032874f';
        }
        if (!isset($attributes[ 'date' ])) {
            $attributes[ 'date' ] = Carbon
                ::now()
                ->day(1)
                ->format('Y-m-d')
            ;
        } else {
            $attributes[ 'date' ] = Carbon
                ::createFromFormat('Y-m-d', $attributes[ 'date' ])
                ->day(1)
                ->format('Y-m-d')
            ;
        }

        $currentDate = $attributes[ 'date' ];

        $dates = ReportCityRatio
            ::select('date')
            ->where('report_type_id', IReportTypeEnum::ReportTypePTR)
            ->where('city_id', $attributes[ 'city_id' ])
            ->where('date', '<=', $attributes[ 'date' ])
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('date')
        ;

        $years = [];

        foreach ($dates as $date) {
            $date = Carbon::createFromFormat('Y-m-d', $date);
            if (!in_array($date->year, $years, true)) {
                $years[] = $date->year;
            }
        }

        $dateGlobal      = Carbon::createFromFormat('Y-m-d', $currentDate);
        $dateStartGlobal = Carbon::createFromFormat('Y-m-d', $currentDate)
                                 ->month(1)
                                 ->day(1)
        ;

        $result = [
            'month'                 => [
                'physicalVolumeIndexIndustrialProductionFact' => 0,
                'physicalVolumeIndexIndustrialProductionPlan' => 0,
                'physicalVolumeIndexExportVolumeFact'         => 0,
                'physicalVolumeIndexExportVolumePlan'         => 0,
                'physicalVolumeIndexInvectFact'               => 0,
                'physicalVolumeIndexInvectPlan'               => 0,
                'By_months'                                   => [],
                'export_by_quarter'                           => [],
            ],
            'TOP_IFO_increasing'    => [],
            'TOP_IFO_decreasing'    => [],
            'TOP_export_increasing' => [],
            'TOP_export_decreasing' => [],
            'TOP_invest_increasing' => [],
            'TOP_invest_decreasing' => [],
        ];

        $physicalVolumeIndexIndustrialProductionFact = ReportCityRatio
            ::where('report_type_id', IReportTypeEnum::ReportTypePTR)
            ->where('city_id', $attributes[ 'city_id' ])
            ->where('date', '<=', $currentDate)
            ->where('ratio_id', IPrtReport::PhysicalVolumeIndexProcessingIndustrialFact)
            ->orderBy('date')
            ->get([ 'value', 'date', 'ratio_id' ])
            ->last()
        ;

        $result[ 'month' ][ 'physicalVolumeIndexIndustrialProductionFact' ] = $physicalVolumeIndexIndustrialProductionFact
            ? (float)$physicalVolumeIndexIndustrialProductionFact->value
            : 0;

        $physicalVolumeIndexDate = $physicalVolumeIndexIndustrialProductionFact
            ? $physicalVolumeIndexIndustrialProductionFact->date
            : $currentDate;

        $physicalVolumeIndexIndustrialProductionPlan = ReportCityRatio
            ::where('report_type_id', IReportTypeEnum::ReportTypePTR)
            ->where('city_id', $attributes[ 'city_id' ])
            ->where('date', $physicalVolumeIndexDate)
            ->where('ratio_id', IPrtReport::PhysicalVolumeIndexProcessingIndustrialPlan)
            ->orderBy('date')
            ->get([ 'value', 'date' ])
            ->last()
        ;

        $result[ 'month' ][ 'physicalVolumeIndexIndustrialProductionPlan' ] = $physicalVolumeIndexIndustrialProductionPlan
            ? (float)$physicalVolumeIndexIndustrialProductionPlan->value
            : 0;

        $physicalVolumeIndexExportVolumeFact = ReportCityRatio
            ::where('report_type_id', IReportTypeEnum::ReportTypePTR)
            ->where('city_id', $attributes[ 'city_id' ])
            ->where('date', '<=', $currentDate)
            ->where('ratio_id', IPrtReport::NonResourceExportGrowthFact)
            ->orderBy('date')
            ->get([ 'value', 'date', 'ratio_id' ])
            ->last()
        ;

        $result[ 'month' ][ 'physicalVolumeIndexExportVolumeFact' ] = $physicalVolumeIndexExportVolumeFact
            ? (float)$physicalVolumeIndexExportVolumeFact->value
            : 0;

        $physicalVolumeIndexExportVolumeDate = $physicalVolumeIndexExportVolumeFact
            ? $physicalVolumeIndexExportVolumeFact->date
            : $currentDate;

        $physicalVolumeIndexIndustrialProductionPlan = ReportCityRatio
            ::where('report_type_id', IReportTypeEnum::ReportTypePTR)
            ->where('city_id', $attributes[ 'city_id' ])
            ->where('date', $physicalVolumeIndexExportVolumeDate)
            ->where('ratio_id', IPrtReport::NonResourceExportGrowthPlan)
            ->orderBy('date')
            ->get([ 'value', 'date' ])
            ->last()
        ;

        $result[ 'month' ][ 'physicalVolumeIndexExportVolumePlan' ] = $physicalVolumeIndexIndustrialProductionPlan
            ? (float)$physicalVolumeIndexIndustrialProductionPlan->value
            : 0;

        $physicalVolumeIndexInvectFact = ReportCityRatio
            ::where('report_type_id', IReportTypeEnum::ReportTypePTR)
            ->where('city_id', $attributes[ 'city_id' ])
            ->where('date', '<=', $currentDate)
            ->where('ratio_id', IPrtReport::MainCapitalInvestmentsFact)
            ->orderBy('date')
            ->get([ 'value', 'date', 'ratio_id' ])
            ->last()
        ;

        $physicalVolumeIndexInvectDate = $physicalVolumeIndexInvectFact
            ? $physicalVolumeIndexInvectFact->date
            : $currentDate;

        $physicalVolumeIndexInvectPlan = ReportCityRatio
            ::where('report_type_id', IReportTypeEnum::ReportTypePTR)
            ->where('city_id', $attributes[ 'city_id' ])
            ->where('date', $physicalVolumeIndexInvectDate)
            ->where('ratio_id', IPrtReport::MainCapitalInvestmentsPlan)
            ->orderBy('date')
            ->get([ 'value', 'date' ])
            ->last()
        ;

        $physicalVolumeIndexInvectPlanAmount = ReportCityRatio
            ::where('report_type_id', IReportTypeEnum::ReportTypePTR)
            ->where('city_id', $attributes[ 'city_id' ])
            ->where('date', $physicalVolumeIndexInvectDate)
            ->where('ratio_id', IPrtReport::MainCapitalInvestmentsPlanAmount)
            ->orderBy('date')
            ->get([ 'value', 'date' ])
            ->last()
        ;

        $result[ 'month' ][ 'physicalVolumeIndexInvectFact' ] = $physicalVolumeIndexInvectFact
                                                                && $physicalVolumeIndexInvectPlanAmount
                                                                && (int)$physicalVolumeIndexInvectPlanAmount->value
                                                                   !== 0
            ? (float)$physicalVolumeIndexInvectFact->value * 100 / (float)$physicalVolumeIndexInvectPlanAmount->value
            : 0;

        $result[ 'month' ][ 'physicalVolumeIndexInvectPlan' ] = $physicalVolumeIndexInvectPlan
            ? (float)$physicalVolumeIndexInvectPlan->value
            : 0;

        $month = 1;

        $lastIfoDate = ReportCityRatio
            ::where('report_type_id', IReportTypeEnum::ReportTypePTR)
            ->where('city_id', $attributes[ 'city_id' ])
            ->where('ratio_id', IPrtReport::IfoProcessingIndustrialDynamic)
            ->max('date')
        ;

        $lastIfoDate = $lastIfoDate
            ? Carbon::createFromFormat('Y-m-d', $lastIfoDate)
            : $dateStartGlobal;

        $lastInvestDate = ReportCityRatio
            ::where('report_type_id', IReportTypeEnum::ReportTypePTR)
            ->where('city_id', $attributes[ 'city_id' ])
            ->where('ratio_id', IPrtReport::MainCapitalInvestmentsFact)
            ->max('date')
        ;

        $lastInvestDate = $lastInvestDate
            ? Carbon::createFromFormat('Y-m-d', $lastInvestDate)
            : $dateStartGlobal;

        while ($month <= 12) {
            $monthDateStartIfo    = $lastIfoDate
                ->clone()
                ->month($month)
            ;
            $monthDateStarIfoStr = $monthDateStartIfo
                ->format('Y-m-d');

            $monthDateStartInvest    = $lastInvestDate
                ->clone()
                ->month($month)
            ;
            $monthDateStartInvestStr = $monthDateStartInvest
                ->format('Y-m-d');

            $ifo = ReportCityRatio
                ::where('report_type_id', IReportTypeEnum::ReportTypePTR)
                ->where('city_id', $attributes[ 'city_id' ])
                ->where('date', $monthDateStarIfoStr)
                ->where('ratio_id', IPrtReport::IfoProcessingIndustrialDynamic)
                ->orderBy('date')
                ->get([ 'value', 'date' ])
                ->last()
            ;

            $invest = ReportCityRatio
                ::where('report_type_id', IReportTypeEnum::ReportTypePTR)
                ->where('city_id', $attributes[ 'city_id' ])
                ->where('date', $monthDateStartInvestStr)
                ->where('ratio_id', IPrtReport::MainCapitalInvestmentsFact)
                ->orderBy('date')
                ->get([ 'value', 'date' ])
                ->last()
            ;

            $monthData = [
                'name'   => $monthDateStartIfo->translatedFormat('F'),
                'IFO'    => $ifo
                    ? $ifo->value
                    : 0,
                'Invest' => $invest
                    ? $invest->value
                    : 0,
                'order' => $month,
            ];

            $result[ 'month' ][ 'By_months' ][] = $monthData;
            $month++;
        }

        $quarter     = 0;
        $dateQuarter = $dateGlobal->clone();

        while ($quarter <= 4) {
            $dateQuarterLast  = $dateQuarter->lastOfQuarter();
            $dateQuarterFirst = $dateQuarter->clone()
                                            ->firstOfQuarter()
            ;

            $quarterValue = ReportCityRatio
                ::where('report_type_id', IReportTypeEnum::ReportTypePTR)
                ->where('city_id', $attributes[ 'city_id' ])
                ->where('date', '>=', $dateQuarterFirst->format('Y-m-d'))
                ->where('date', '<=', $dateQuarterLast->format('Y-m-d'))
                ->where('ratio_id', IPrtReport::NonResourceExportDynamic)
                ->orderBy('date')
                ->get([ 'value', 'ratio_id' ])
                ->last()
            ;

            $result[ 'month' ][ 'export_by_quarter' ][] = [
                'name'  =>
                    $dateQuarterLast->quarter
                    . ' кв. '
                    . $dateQuarterLast->format('Y'),
                'value' => $quarterValue
                    ? $quarterValue->value
                    : 0,
            ];

            $quarter++;
            $dateQuarter->subMonths(4);
        }

        $ifoTopListDate = $this->getLastRatioDate(
            $currentDate,
            IReportTypeEnum::ReportTypePTR,
            $attributes[ 'city_id' ],
            IPrtReport::Top5IndustryIfoList
        );

        $ifoTopList = ReportCityRatio
            ::where('report_type_id', IReportTypeEnum::ReportTypePTR)
            ->where('city_id', $attributes[ 'city_id' ])
            ->where('date', $ifoTopListDate)
            ->whereIn('ratio_id', IPrtReport::Top5IndustryIfoList)
            ->orderBy('value')
            ->get([ 'value', 'ratio_id' ])
            ->map(
                function ($item)
                {
                    return [
                        'name'  => trans(IPrtReport::IndustryNames[ $item->ratio_id ]),
                        'value' => $item->value,
                    ];
                }
            )
        ;

        $ifoTopListUp = $ifoTopList->sortBy('value', SORT_REGULAR, true)
                                   ->slice(0, 5)
                                   ->toArray()
        ;

        $ifoTopListDown = $ifoTopList->sortBy('value')
                                     ->slice(0, 5)
                                     ->toArray()
        ;

        $result[ 'TOP_IFO_decreasing' ] = $ifoTopListDown;
        $result[ 'TOP_IFO_increasing' ] = $ifoTopListUp;

        $exportDate = $this->getLastRatioDate(
            $currentDate,
            IReportTypeEnum::ReportTypePTR,
            $attributes[ 'city_id' ],
            IPrtReport::Top5ExportList
        );

        $export = ReportCityRatio
            ::where('report_type_id', IReportTypeEnum::ReportTypePTR)
            ->where('city_id', $attributes[ 'city_id' ])
            ->where('date', $exportDate)
            ->whereIn('ratio_id', IPrtReport::Top5ExportList)
            ->orderBy('value')
            ->get([ 'value', 'ratio_id' ])
            ->map(
                function ($item)
                {
                    return [
                        'name'  => trans(IPrtReport::IndustryNames[ $item->ratio_id ]),
                        'value' => $item->value,
                    ];
                }
            )
        ;

        $exportUp = $export->sortBy('value', SORT_REGULAR, true)
                           ->slice(0, 5)
                           ->toArray()
        ;

        $exportDown = $export->sortBy('value')
                             ->slice(0, 5)
                             ->toArray()
        ;

        $result[ 'TOP_export_decreasing' ] = $exportDown;
        $result[ 'TOP_export_increasing' ] = $exportUp;

        $investTop5Date = $this->getLastRatioDate(
            $currentDate,
            IReportTypeEnum::ReportTypePTR,
            $attributes[ 'city_id' ],
            IPrtReport::Top5InvestList
        );

        $investTop5 = ReportCityRatio
            ::where('report_type_id', IReportTypeEnum::ReportTypePTR)
            ->where('city_id', $attributes[ 'city_id' ])
            ->where('date', $investTop5Date)
            ->whereIn('ratio_id', IPrtReport::Top5InvestList)
            ->orderBy('value')
            ->get([ 'value', 'ratio_id' ])
            ->map(
                function ($item)
                {
                    return [
                        'name'  => trans(IPrtReport::IndustryNames[ $item->ratio_id ]),
                        'value' => (float)$item->value,
                    ];
                }
            )
        ;

        $investTotal = $investTop5->reduce(
            function ($acc, $item)
            {
                return $acc + $item[ 'value' ];
            },
            0
        );

        $investTop5 = $investTop5->map(
            function ($item) use ($investTotal)
            {
                if ((int)$investTotal !== 0) {
                    $item[ 'value' ] = $item[ 'value' ] * 100 / (float)$investTotal;
                } else {
                    $item[ 'value' ] = 0;
                }
                return $item;
            }
        );

        $investTop5Up = $investTop5->sortBy('value', SORT_REGULAR, true)
                                   ->slice(0, 5)
                                   ->toArray()
        ;

        $investTop5Down = $investTop5->sortBy('value')
                                     ->slice(0, 5)
                                     ->toArray()
        ;

        $result[ 'TOP_invest_decreasing' ] = $investTop5Down;
        $result[ 'TOP_invest_increasing' ] = $investTop5Up;

        return [ $result ];
    }

    private function getLastRatioDate(string $date, int $reportTypeId, string $cityId, array $ratioIds): ?string
    {
        $lastDate =  ReportCityRatio
            ::where('report_type_id', $reportTypeId)
            ->where('city_id', $cityId)
            ->whereIn('ratio_id', $ratioIds)
            ->where('value', '!=', 0)
            ->where('date', '<=', $date)
            ->max('date')
            ;
        if($lastDate === null)
        {
            return $date;
        }

        return  $lastDate;
    }

}

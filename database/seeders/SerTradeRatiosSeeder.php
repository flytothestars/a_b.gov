<?php

namespace Database\Seeders;

use App\Models\Report\ReportCityRatio;
use App\Models\Report\ReportDistrictRatio;
use App\Models\Report\ReportRatio;
use App\Repositories\Enums\Reports\IRatioScopeEnum;
use App\Repositories\Enums\Reports\IReportTypeEnum;
use App\Repositories\Enums\Reports\ITradeReportRatioEnum;
use App\Repositories\Enums\Reports\Ser\ITradeRatioReport;
use Illuminate\Database\Seeder;

class SerTradeRatiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    final public function run(): void
    {
        ReportCityRatio
            ::whereIn('ratio_id', ITradeReportRatioEnum::OldRatios)
            ->delete()
        ;
        ReportDistrictRatio
            ::whereIn('ratio_id', ITradeReportRatioEnum::OldRatios)
            ->delete()
        ;
        ReportRatio
            ::whereIn('id', ITradeReportRatioEnum::OldRatios)
            ->delete()
        ;

        $ratios = [
            [
                'id'             => ITradeRatioReport::EnterpriseNumber,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeTrade,
                'name'           => trans(
                    ITradeRatioReport::RatioNames[ ITradeRatioReport::EnterpriseNumber ]
                ),
            ],
            [
                'id'             => ITradeRatioReport::Employed,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeTrade,
                'name'           => trans(
                    ITradeRatioReport::RatioNames[ ITradeRatioReport::Employed ]
                ),
            ],
            [
                'id'             => ITradeRatioReport::AverageSalary,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeTrade,
                'name'           => trans(
                    ITradeRatioReport::RatioNames[ ITradeRatioReport::AverageSalary ]
                ),
            ],
            [
                'id'             => ITradeRatioReport::TaxRevenues,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeTrade,
                'name'           => trans(
                    ITradeRatioReport::RatioNames[ ITradeRatioReport::TaxRevenues ]
                ),
            ],
            [
                'id'             => ITradeRatioReport::TradeWholesaleTurnover,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeTrade,
                'name'           => trans(
                    ITradeRatioReport::RatioNames[ ITradeRatioReport::TradeWholesaleTurnover ]
                ),
            ],
            [
                'id'             => ITradeRatioReport::TradeWholesaleStructureFood,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeTrade,
                'name'           => trans(
                    ITradeRatioReport::RatioNames[ ITradeRatioReport::TradeWholesaleStructureFood ]
                ),
            ],
            [
                'id'             => ITradeRatioReport::TradeWholesaleStructureNonFood,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeTrade,
                'name'           => trans(
                    ITradeRatioReport::RatioNames[ ITradeRatioReport::TradeWholesaleStructureNonFood ]
                ),
            ],
            [
                'id'             => ITradeRatioReport::TradeWholesalePhysicalVolumeIndex,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeTrade,
                'name'           => trans(
                    ITradeRatioReport::RatioNames[ ITradeRatioReport::TradeWholesalePhysicalVolumeIndex ]
                ),
            ],
            [
                'id'             => ITradeRatioReport::TradeWholesaleTurnoverByDistrict,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_REGION,
                'report_type_id' => IReportTypeEnum::ReportTypeTrade,
                'name'           => trans(
                    ITradeRatioReport::RatioNames[ ITradeRatioReport::TradeWholesaleTurnoverByDistrict ]
                ),
            ],
            [
                'id'             => ITradeRatioReport::TradeRetailTurnover,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeTrade,
                'name'           => trans(
                    ITradeRatioReport::RatioNames[ ITradeRatioReport::TradeRetailTurnover ]
                ),
            ],
            [
                'id'             => ITradeRatioReport::TradeRetailStructureFood,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeTrade,
                'name'           => trans(
                    ITradeRatioReport::RatioNames[ ITradeRatioReport::TradeRetailStructureFood ]
                ),
            ],
            [
                'id'             => ITradeRatioReport::TradeRetailStructureNonFood,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeTrade,
                'name'           => trans(
                    ITradeRatioReport::RatioNames[ ITradeRatioReport::TradeRetailStructureNonFood ]
                ),
            ],
            [
                'id'             => ITradeRatioReport::TradeRetailPhysicalVolumeIndex,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeTrade,
                'name'           => trans(
                    ITradeRatioReport::RatioNames[ ITradeRatioReport::TradeRetailPhysicalVolumeIndex ]
                ),
            ],
            [
                'id'             => ITradeRatioReport::TradeRetailTurnoverByDistrict,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_REGION,
                'report_type_id' => IReportTypeEnum::ReportTypeTrade,
                'name'           => trans(
                    ITradeRatioReport::RatioNames[ ITradeRatioReport::TradeRetailTurnoverByDistrict ]
                ),
            ],
        ];

        ReportRatio::insert($ratios);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Report\ReportRatio;
use App\Repositories\Enums\Reports\Ser\IBusinessStatisticsRatioEnum;
use App\Repositories\Enums\Reports\IRatioScopeEnum;
use App\Repositories\Enums\Reports\IReportTypeEnum;
use Illuminate\Database\Seeder;

class SerBusinessStatReportDistrictsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    final public function run(): void
    {
        $ratios = [
            [
                'id'             => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberDistrict,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_REGION,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumber ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberDistrict,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_REGION,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::OperatingEnterprisesNumber ]
                ),
            ],
        ];

        ReportRatio::insert($ratios);
    }
}

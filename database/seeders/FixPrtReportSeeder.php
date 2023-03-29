<?php

namespace Database\Seeders;

use App\Contracts\Taldau\ITaldauApiUrlContract;
use App\Models\Report\ReportRatio;
use App\Models\Taldau\TaldauApiUrl;
use App\Repositories\Enums\Reports\IRatioScopeEnum;
use App\Repositories\Enums\Reports\IReportTypeEnum;
use App\Repositories\Enums\Reports\Prt\IPrtReport;
use Illuminate\Database\Seeder;

class FixPrtReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    final public function run(): void
    {
        ReportRatio::create(
            [
                'id'             => IPrtReport::PhysicalVolumeIndexProcessingIndustrialFact,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::PhysicalVolumeIndexProcessingIndustrialFact ]
                ),
            ]
        );
        ReportRatio::create(
            [
                'id'             => IPrtReport::MainCapitalInvestmentsPlanAmount,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::MainCapitalInvestmentsPlanAmount ]
                ),
            ]
        );
        TaldauApiUrl::create(
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701625&p_keyword=&p_period_id=4&p_measure_id=7&p_term_id=741880&p_terms=741880%2C3078734%2C2695732&p_dicIds=68%2C4303%2C848&idx=0',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::PhysicalVolumeIndexProcessingIndustrialFact,
            ],
        );

    }
}

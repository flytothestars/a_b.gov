<?php

namespace Database\Seeders;

use App\Contracts\Taldau\ITaldauApiUrlContract;
use App\Models\Taldau\TaldauApiUrl;
use App\Repositories\Enums\Reports\IReportTypeEnum;
use App\Repositories\Enums\Reports\Ser\IInvestmentReport;
use App\Repositories\Enums\Reports\Ser\ITradeRatioReport;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class SerPrtRatioFixSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ratios = [
            // ITradeRatioReport
            [
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeTrade,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => ITradeRatioReport::TradeWholesalePhysicalVolumeIndex,
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                'url'                                        => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_index_id=702022&p_keyword=&p_period_id=8&p_measure_id=7&p_term_id=741880&p_terms=741880,741879,2695732&p_dicIds=68,316,848&idx=0&levels=2,3',
            ],
            // ReportTypeInvestments
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701827&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,741927,'
                                                                . IInvestmentReport::InvestmentGovernmentIds[ IInvestmentReport::InvestmentGovernmentLocal ]
                                                                . '&p_dicIds=68,776,90,459&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::InvestmentGovernmentLocal,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701827&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,741927,'
                                                                . IInvestmentReport::InvestmentGovernmentIds[ IInvestmentReport::InvestmentGovernmentRepublic ]
                                                                . '&p_dicIds=68,776,90,459&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::InvestmentGovernmentRepublic,
            ],
        ];

        foreach ($ratios as $ratio) {
            $exists = TaldauApiUrl::where('report_ratio_id', $ratio[ 'report_ratio_id' ])
                                  ->first()
            ;
            if (!$exists) {
                $ratio[ 'id' ] = Uuid::uuid4();
                TaldauApiUrl::create($ratio);
            } else {
                $item = TaldauApiUrl::where('report_ratio_id', $ratio[ 'report_ratio_id' ])
                                    ->first()
                ;
                if ($item) {
                    $item->fill($ratio);
                    $item->save();
                }
            }

        }
    }
}

<?php

namespace Database\Seeders;

use App\Contracts\Taldau\ITaldauApiUrlContract;
use App\Models\Taldau\TaldauApiUrl;
use App\Repositories\Enums\Reports\IReportTypeEnum;
use App\Repositories\Enums\Reports\Ser\ITradeRatioReport;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class SerTradeRatiosUrlSeeder extends Seeder
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
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701159&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=268020&p_terms=268020,448215,741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeTrade,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => ITradeRatioReport::EnterpriseNumber,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=702882&p_keyword=&p_period_id=5&p_measure_id=23&p_term_id=741880&p_terms=741880,448215,741917,741935,3805694,4197331&p_dicIds=67,915,749,576,1773,1793&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeTrade,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => ITradeRatioReport::Employed,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=702972&p_keyword=&p_period_id=5&p_measure_id=1&p_term_id=741880&p_terms=741880,448215,741917,3629946&p_dicIds=68,859,776,2813&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeTrade,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => ITradeRatioReport::AverageSalary,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=702020&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741879&p_dicIds=68,316&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeTrade,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => ITradeRatioReport::TradeWholesaleTurnover,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => '',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeTrade,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => ITradeRatioReport::EnterpriseNumber,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=702020&p_keyword=&p_period_id=7&p_measure_id=1&p_term_id=741880&p_terms=741880,741927,'
                                                                . ITradeRatioReport::TradeWholesaleStructureIds[ ITradeRatioReport::TradeWholesaleStructureFood ]
                                                                . '&p_dicIds=67,90,676&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeTrade,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => ITradeRatioReport::TradeWholesaleStructureFood,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=702020&p_keyword=&p_period_id=7&p_measure_id=1&p_term_id=741880&p_terms=741880,741927,'
                                                                . ITradeRatioReport::TradeWholesaleStructureIds[ ITradeRatioReport::TradeWholesaleStructureNonFood ]
                                                                . '&p_dicIds=67,90,676&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeTrade,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => ITradeRatioReport::TradeWholesaleStructureNonFood,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=702022&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741879,2695730&p_dicIds=68,316,848&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeTrade,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => ITradeRatioReport::TradeWholesalePhysicalVolumeIndex,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=268020&p_index_id=702020&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741879&p_dicIds=68,316&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeTrade,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => ITradeRatioReport::TradeWholesaleTurnoverByDistrict,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=702038&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741927&p_dicIds=68,90&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeTrade,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => ITradeRatioReport::TradeRetailTurnover,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=702038&p_keyword=&p_period_id=7&p_measure_id=1&p_term_id=741880&p_terms=741880,741907,'
                                                                . ITradeRatioReport::TradeRetailStructureIds[ ITradeRatioReport::TradeRetailStructureFood ]
                                                                . '&p_dicIds=68,59,676&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeTrade,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => ITradeRatioReport::TradeRetailStructureFood,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=702038&p_keyword=&p_period_id=7&p_measure_id=1&p_term_id=741880&p_terms=741880,741907,'
                                                                . ITradeRatioReport::TradeRetailStructureIds[ ITradeRatioReport::TradeRetailStructureNonFood ]
                                                                . '&p_dicIds=68,59,676&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeTrade,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => ITradeRatioReport::TradeRetailStructureNonFood,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=702041&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741879,2695732&p_dicIds=67,316,848&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeTrade,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => ITradeRatioReport::TradeRetailPhysicalVolumeIndex,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=268020&p_index_id=702038&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741927&p_dicIds=68,90&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeTrade,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => ITradeRatioReport::TradeRetailTurnoverByDistrict,
            ],
        ];

        foreach ($ratios as $key => $ratio) {
            $ratios[ $key ][ ITaldauApiUrlContract::FIELD_ID ] = Uuid::uuid4();
        }

        TaldauApiUrl::insert($ratios);
    }
}

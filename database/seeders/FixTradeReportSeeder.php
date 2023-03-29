<?php

namespace Database\Seeders;

use App\Contracts\Taldau\ITaldauApiUrlContract;
use App\Models\Report\ReportRatio;
use App\Models\Taldau\TaldauApiUrl;
use App\Repositories\Enums\Reports\IRatioScopeEnum;
use App\Repositories\Enums\Reports\IReportTypeEnum;
use App\Repositories\Enums\Reports\Ser\ITradeRatioReport;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class FixTradeReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tradeDynamicWholesaleRatio =  [
            'id'             => ITradeRatioReport::TradeWholesaleTurnoverByYears,
            'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
            'report_type_id' => IReportTypeEnum::ReportTypeTrade,
            'name'           => trans(
                ITradeRatioReport::RatioNames[ ITradeRatioReport::TradeWholesaleTurnoverByYears ]
            ),
        ];

        $tradeDynamicRetailRatio =  [
            'id'             => ITradeRatioReport::TradeRetailTurnoverByYears,
            'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
            'report_type_id' => IReportTypeEnum::ReportTypeTrade,
            'name'           => trans(
                ITradeRatioReport::RatioNames[ ITradeRatioReport::TradeRetailTurnoverByYears ]
            ),
        ];


        ReportRatio::insert($tradeDynamicWholesaleRatio);
        ReportRatio::insert($tradeDynamicRetailRatio);



        $tradeDynamicWholesale =    [
            ITaldauApiUrlContract::FIELD_ID       => Uuid::uuid4(),
            ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
            ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=702020&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741907&p_dicIds=67,59&idx=0&id=&levels=2,3',
            ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeTrade,
            ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => ITradeRatioReport::TradeWholesaleTurnoverByYears,
        ];

        TaldauApiUrl::insert($tradeDynamicWholesale);

        $tradeDynamicRetail =    [
            ITaldauApiUrlContract::FIELD_ID       => Uuid::uuid4(),
            ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
            ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=702038&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741907&p_dicIds=68,59&idx=0&id=&levels=2,3',
            ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeTrade,
            ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => ITradeRatioReport::TradeRetailTurnoverByYears,
        ];

        TaldauApiUrl::insert($tradeDynamicRetail);
    }
}

<?php

namespace Database\Seeders;

use App\Contracts\Taldau\ITaldauApiUrlContract;
use App\Models\Taldau\TaldauApiUrl;
use App\Repositories\Enums\Reports\Ser\ITradeRatioReport;
use Illuminate\Database\Seeder;

class FixTradeReportSeederSecond extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    final public function run(): void
    {
        $tradeWholesaleStructureFood = TaldauApiUrl
            ::where(ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID, ITradeRatioReport::TradeWholesaleStructureFood)
            ->first();


        if($tradeWholesaleStructureFood)
        {
            $tradeWholesaleStructureFood->url = 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=702020&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880%2C741917%2C18224345&p_dicIds=67%2C749%2C3013&idx=0&id=741880';
            $tradeWholesaleStructureFood->save();
        }

        $tradeWholesaleStructureNonFood = TaldauApiUrl
            ::where(ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID, ITradeRatioReport::TradeWholesaleStructureNonFood)
            ->first();


        if($tradeWholesaleStructureNonFood)
        {
            $tradeWholesaleStructureNonFood->url = 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=702020&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880%2C741917%2C18224350&p_dicIds=67%2C749%2C3013&idx=0&id=741880';
            $tradeWholesaleStructureNonFood->save();
        }

        $tradeRetailStructureFood = TaldauApiUrl
            ::where(ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID, ITradeRatioReport::TradeRetailStructureFood)
            ->first();


        if($tradeRetailStructureFood)
        {
            $tradeRetailStructureFood->url = 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=702038&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880%2C741917%2C18224345&p_dicIds=67%2C749%2C3013&idx=0';
            $tradeRetailStructureFood->save();
        }

        $tradeRetailStructureNonFood = TaldauApiUrl
            ::where(ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID, ITradeRatioReport::TradeRetailStructureNonFood)
            ->first();


        if($tradeRetailStructureNonFood)
        {
            $tradeRetailStructureNonFood->url = 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=702038&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880%2C741917%2C18224350&p_dicIds=67%2C749%2C3013&idx=0';
            $tradeRetailStructureNonFood->save();
        }

        $tradeRetailTurnoverByDistrict = TaldauApiUrl
            ::where(ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID, ITradeRatioReport::TradeRetailTurnoverByDistrict)
            ->first();


        if($tradeRetailTurnoverByDistrict)
        {
            $tradeRetailTurnoverByDistrict->url = 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=268020&p_index_id=702038&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880%2C741907&p_dicIds=68%2C59&idx=0';
            $tradeRetailTurnoverByDistrict->save();
        }
    }
}

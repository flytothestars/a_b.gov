<?php

namespace Database\Seeders;

use App\Contracts\Taldau\ITaldauApiUrlContract;
use App\Models\Taldau\TaldauApiUrl;
use App\Repositories\Enums\Reports\Ser\IInvestmentReport;
use Illuminate\Database\Seeder;

class FixInvestmentReportSeederSecond extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $investmentByCostTypeMachinery = TaldauApiUrl
            ::where(ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID, IInvestmentReport::InvestmentByCostTypeOtherCapital)
            ->first();


        if($investmentByCostTypeMachinery)
        {
            $investmentByCostTypeMachinery->url = 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=7&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,741927,741885,19202539&p_dicIds=68,776,90,3028,4043&idx=0&id=&levels=2,3';
            $investmentByCostTypeMachinery->save();
        }


    }
}

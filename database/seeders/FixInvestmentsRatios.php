<?php

namespace Database\Seeders;

use App\Contracts\Taldau\ITaldauApiUrlContract;
use App\Models\Taldau\TaldauApiUrl;
use App\Repositories\Enums\Reports\Ser\IInvestmentReport;
use Illuminate\Database\Seeder;

class FixInvestmentsRatios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    final public function run(): void
    {
        $investmentOwnUrl = TaldauApiUrl
            ::where(ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID, IInvestmentReport::InvestmentOwn)
            ->first();

        if($investmentOwnUrl)
        {
            $investmentOwnUrl->url = 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=19806558&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741907,451902&p_dicIds=68,59,459&idx=0&id=&levels=2,3';
            $investmentOwnUrl->save();
        }


        $investmentLoanUrl = TaldauApiUrl
            ::where(ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID, IInvestmentReport::InvestmentLoan)
            ->first();

        if($investmentLoanUrl)
        {
            $investmentLoanUrl->url = 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=19806558&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741907,3767702&p_dicIds=68,59,459&idx=0&id=&levels=2,3';
            $investmentLoanUrl->save();
        }
    }
}

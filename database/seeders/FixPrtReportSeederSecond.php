<?php

namespace Database\Seeders;

use App\Contracts\Taldau\ITaldauApiUrlContract;
use App\Models\Taldau\TaldauApiUrl;
use App\Repositories\Enums\Reports\IReportTypeEnum;
use App\Repositories\Enums\Reports\Prt\IPrtReport;
use Illuminate\Database\Seeder;

class FixPrtReportSeederSecond extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    final public function run(): void
    {
        $mainCapitalInvestmentsFact = TaldauApiUrl
            ::where(ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID, IPrtReport::MainCapitalInvestmentsFact)
            ->first()
        ;

        if ($mainCapitalInvestmentsFact) {
            $mainCapitalInvestmentsFact->url = 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3';
            $mainCapitalInvestmentsFact->save();
        }
        $ifoProcessingIndustrialDynamic = TaldauApiUrl
            ::where(ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID, IPrtReport::IfoProcessingIndustrialDynamic)
            ->first()
        ;

        if ($ifoProcessingIndustrialDynamic) {
            $ifoProcessingIndustrialDynamic->url = 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701625&p_keyword=&p_period_id=4&p_measure_id=7&p_term_id=741880&p_terms=741880,3078734,2695732&p_dicIds=68,4303,848&idx=0&id=&levels=2,3';
            $ifoProcessingIndustrialDynamic->save();
        }

        foreach (IPrtReport::Top5IndustryIfoList as $ratioId) {
            $ratioUrl = TaldauApiUrl
                ::where(ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID, $ratioId)
                ->first()
            ;
            if (!$ratioUrl) {
                $ratioUrl = new TaldauApiUrl;
            }

            $ratioUrl->fill(
                [
                    ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                    ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880'
                                                                    . '&p_index_id=701851&p_keyword=&p_period_id=4&p_measure_id=7'
                                                                    . '&p_term_id=741880'
                                                                    . '&p_terms=741880,'
                                                                    . IPrtReport::IndustryIds[ $ratioId ]
                                                                    . ',741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
                    ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                    ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => $ratioId,
                ]
            );
            $ratioUrl->save();

        }

        foreach (IPrtReport::Top5InvestList as $ratioId) {
            $ratioUrl = TaldauApiUrl
                ::where(ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID, $ratioId)
                ->first()
            ;
            if (!$ratioUrl) {
                $ratioUrl = new TaldauApiUrl;
            }

            $ratioUrl->fill(
                [
                    ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                    ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880'
                                                                    . '&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1'
                                                                    . '&p_term_id=741880'
                                                                    . '&p_terms=741880,741927,807855,'
                                                                    . IPrtReport::IndustryIds[ $ratioId ]
                                                                    . '&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                    ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                    ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => $ratioId,
                ]
            );
            $ratioUrl->save();

        }
        foreach (IPrtReport::DisabledIndustry as $ratioId) {
            $ratioUrl = TaldauApiUrl
                ::where(ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID, $ratioId)
                ->first()
            ;
            if ($ratioUrl) {
                $ratioUrl->is_active = false;
                $ratioUrl->save();
            }
        }

    }
}

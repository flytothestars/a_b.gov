<?php

namespace Database\Seeders;

use App\Contracts\Taldau\ITaldauApiUrlContract;
use App\Models\Taldau\TaldauApiUrl;
use App\Repositories\Enums\Reports\IReportTypeEnum;
use App\Repositories\Enums\Reports\Ser\IIndustryRatioReport;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class FixIndustryReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    final public function run(): void
    {
        $ratio = TaldauApiUrl
            ::where(ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID, IReportTypeEnum::ReportTypeIndustry)
            ->where(ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID, IIndustryRatioReport::AverageSalary)
            ->first()
        ;

        if (!$ratio) {
            TaldauApiUrl::create(
                [
                    ITaldauApiUrlContract::FIELD_ID              => Uuid::uuid4(),
                    ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                    ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=702972&p_keyword=&p_period_id=5&p_measure_id=1&p_term_id=741880&p_terms=741880,741340,741917,3629946&p_dicIds=68,859,776,2813&idx=0&id=&levels=2,3',
                    ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeIndustry,
                    ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IIndustryRatioReport::AverageSalary,
                ]
            );
        } else {
            $ratio->url = 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=702972&p_keyword=&p_period_id=5&p_measure_id=1&p_term_id=741880&p_terms=741880,741340,741917,3629946&p_dicIds=68,859,776,2813&idx=0&id=&levels=2,3';
            $ratio->save();
        }

    }
}

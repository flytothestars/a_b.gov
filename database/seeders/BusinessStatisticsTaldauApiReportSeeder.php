<?php

namespace Database\Seeders;

use App\Contracts\Taldau\ITaldauApiUrlContract;
use App\Repositories\Enums\Reports\IReportTypeEnum;
use Illuminate\Database\Seeder;

class BusinessStatisticsTaldauApiReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $apiList = [
          [
                  ITaldauApiUrlContract::FIELD_ID => 1,
                  ITaldauApiUrlContract::FIELD_IS_ACTIVE => true,
                  ITaldauApiUrlContract::FIELD_URL => '',
                  ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID => IReportTypeEnum::ReportBusinessStatistics,
                  ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => '',
          ],
          [
                  ITaldauApiUrlContract::FIELD_ID => 1,
                  ITaldauApiUrlContract::FIELD_IS_ACTIVE => true,
                  ITaldauApiUrlContract::FIELD_URL => '',
                  ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID => IReportTypeEnum::ReportBusinessStatistics,
                  ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => '',
          ],
          [
                  ITaldauApiUrlContract::FIELD_ID => 1,
                  ITaldauApiUrlContract::FIELD_IS_ACTIVE => true,
                  ITaldauApiUrlContract::FIELD_URL => '',
                  ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID => IReportTypeEnum::ReportBusinessStatistics,
                  ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => '',
          ],
          [
                  ITaldauApiUrlContract::FIELD_ID => 1,
                  ITaldauApiUrlContract::FIELD_IS_ACTIVE => true,
                  ITaldauApiUrlContract::FIELD_URL => '',
                  ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID => IReportTypeEnum::ReportBusinessStatistics,
                  ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => '',
          ],
          [
                  ITaldauApiUrlContract::FIELD_ID => 1,
                  ITaldauApiUrlContract::FIELD_IS_ACTIVE => true,
                  ITaldauApiUrlContract::FIELD_URL => '',
                  ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID => IReportTypeEnum::ReportBusinessStatistics,
                  ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => '',
          ],

        ];
    }
}

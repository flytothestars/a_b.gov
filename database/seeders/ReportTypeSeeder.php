<?php

namespace Database\Seeders;

use App\Models\Report\ReportType;
use App\Repositories\Enums\Reports\IReportTypeEnum;
use Illuminate\Database\Seeder;

class ReportTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reports = [
            [ 'id' => IReportTypeEnum::ReportTypeIndustry, 'name' => 'Промышленность' ],
            [ 'id' => IReportTypeEnum::ReportTypeTrade, 'name' => 'Торговля' ],
            [ 'id' => IReportTypeEnum:: ReportTypeInvestments, 'name' => 'Инвестиции' ],
        ];

        ReportType::insert($reports);

    }
}

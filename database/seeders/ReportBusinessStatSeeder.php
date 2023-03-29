<?php

namespace Database\Seeders;

use App\Models\Report\ReportType;
use App\Repositories\Enums\Reports\IReportTypeEnum;
use Illuminate\Database\Seeder;

class ReportBusinessStatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReportType::create(
            [
                'id'   => IReportTypeEnum::ReportBusinessStatistics,
                'name' => 'Статистика предприятий',
            ]
        );

    }
}

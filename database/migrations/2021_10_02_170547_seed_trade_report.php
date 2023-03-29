<?php

use App\Models\Report\ReportType;
use App\Repositories\Enums\Reports\IReportTypeEnum;
use Database\Seeders\TradeReportSeeder;
use Illuminate\Database\Migrations\Migration;

class SeedTradeReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $trade = ReportType::find(IReportTypeEnum::ReportTypeTrade);
        $trade->name = 'Торговля';
        $trade->save();

        $tradeOld = ReportType::find(3);
        if($tradeOld)
        {
            $tradeOld->delete();
        }


        \Illuminate\Support\Facades\Artisan::call('db:seed', [
            '--class' => TradeReportSeeder::class
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

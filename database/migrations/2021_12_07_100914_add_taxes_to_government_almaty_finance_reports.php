<?php

use App\Contracts\GovernmentProgramsReports\IReportTypeAlmatyFinance;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTaxesToGovernmentAlmatyFinanceReports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'government_almaty_finance_reports',
            function (Blueprint $table)
            {
                $table->double(IReportTypeAlmatyFinance::Tax)
                      ->nullable()
                ;
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'government_almaty_finance_reports',
            function (Blueprint $table)
            {
                $table->dropColumn(IReportTypeAlmatyFinance::Tax);
            }
        );
    }
}

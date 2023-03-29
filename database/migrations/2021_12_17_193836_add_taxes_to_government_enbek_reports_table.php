<?php

use App\Contracts\GovernmentProgramsReports\IReportEnbek;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTaxesToGovernmentEnbekReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'government_enbek_reports',
            function (Blueprint $table)
            {
                $table->double(IReportEnbek::Tax)
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
            'government_enbek_reports',
            function (Blueprint $table)
            {
                $table->dropColumn(IReportEnbek::Tax);
            }
        );
    }
}

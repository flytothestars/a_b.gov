<?php

use App\Contracts\GovernmentProgramsReports\IReportAlmatyBusinessMFO;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTaxesToGovernmentBusinessMFOReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('government_business_m_f_o_reports', function (Blueprint $table) {
            $table->double(IReportAlmatyBusinessMFO::Tax)
                  ->nullable()
            ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('government_business_m_f_o_reports', function (Blueprint $table) {
            $table->dropColumn(IReportAlmatyBusinessMFO::Tax);
        });
    }
}

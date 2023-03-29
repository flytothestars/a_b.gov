<?php

use App\Contracts\GovernmentProgramsReports\IReportDKBSubsidies;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTaxesToGovernmentSubsidiesReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('government_subsidies_reports', function (Blueprint $table) {
            $table->double(IReportDKBSubsidies::Tax)
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
        Schema::table('government_subsidies_reports', function (Blueprint $table) {
            $table->dropColumn(IReportDKBSubsidies::Tax);
        });
    }
}

<?php

use App\Contracts\GovernmentProgramsReports\IReportDKBSubsidiesSimpleThings;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTaxesToGovernmentSimpleThingsReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('government_simple_things_reports', function (Blueprint $table) {
            $table->double(IReportDKBSubsidiesSimpleThings::Tax)
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
        Schema::table('government_simple_things_reports', function (Blueprint $table) {
            $table->dropColumn(IReportDKBSubsidiesSimpleThings::Tax);
        });
    }
}

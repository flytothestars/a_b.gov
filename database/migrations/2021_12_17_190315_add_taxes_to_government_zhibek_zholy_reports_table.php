<?php

use App\Contracts\GovernmentProgramsReports\IReportAlmatyBusinessZhibekZholy;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTaxesToGovernmentZhibekZholyReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'government_zhibek_zholy_reports',
            function (Blueprint $table)
            {
                $table->double(IReportAlmatyBusinessZhibekZholy::Tax)
                      ->nullable()
                ;
                $table->unsignedBigInteger(IReportAlmatyBusinessZhibekZholy::CurrentWorkPlaces)
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
            'government_zhibek_zholy_reports',
            function (Blueprint $table)
            {
                $table->dropColumn(IReportAlmatyBusinessZhibekZholy::Tax);
                $table->dropColumn(IReportAlmatyBusinessZhibekZholy::CurrentWorkPlaces);
            }
        );
    }
}

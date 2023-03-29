<?php

use App\Contracts\GovernmentProgramsReports\IReportsHeaders;
use App\Contracts\GovernmentProgramsReports\IReportStatuses;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGovernmentReportHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'government_report_headers',
            function (Blueprint $table)
            {
                $table->uuid('id')->primary();
                $table->unsignedBigInteger(IReportsHeaders::ImportUserId);
                $table->unsignedBigInteger(IReportsHeaders::LastEditorId)
                      ->nullable()
                ;
                $table->integer(IReportsHeaders::ReportType);
                $table->integer(IReportsHeaders::ReportImportStatus)
                      ->default(IReportStatuses::New)
                ;
                $table->date(IReportsHeaders::ImportDate);
                $table->longText(IReportsHeaders::LastFailComment)->nullable();
                $table->timestamps();

                $table->foreign(IReportsHeaders::ImportUserId)
                      ->references('id')
                      ->on('users')
                ;
                $table->foreign(IReportsHeaders::LastEditorId)
                      ->references('id')
                      ->on('users')
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
        Schema::dropIfExists('government_report_headers');
    }
}

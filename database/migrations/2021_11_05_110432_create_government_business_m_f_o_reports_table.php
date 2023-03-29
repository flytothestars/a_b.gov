<?php

use App\Contracts\GovernmentProgramsReports\IReportAlmatyBusinessMFO;
use App\Contracts\GovernmentProgramsReports\IReportStatuses;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGovernmentBusinessMFOReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('government_business_m_f_o_reports', function (Blueprint $table) {
            $table->id();
            $table->uuid(IReportAlmatyBusinessMFO::ReportId);
            $table->integer(IReportAlmatyBusinessMFO::Status)
                ->default(IReportStatuses::New);
            $table->unsignedBigInteger(IReportAlmatyBusinessMFO::Number)
                ->nullable();
            $table->string(IReportAlmatyBusinessMFO::Name)->nullable();
            $table->string(IReportAlmatyBusinessMFO::CurrentActivity)->nullable();
            $table->string(IReportAlmatyBusinessMFO::PlannedTypeOfActivity)->nullable();
            $table->string(IReportAlmatyBusinessMFO::Place)->nullable();
            $table->double(IReportAlmatyBusinessMFO::LimitAmount, 15, 2)->nullable();
            $table->integer(IReportAlmatyBusinessMFO::WorkPlace)->nullable();
            $table->string(IReportAlmatyBusinessMFO::CompanyBinIin)->nullable();

            $table->uuid(IReportAlmatyBusinessMFO::ProgramDistrictId)
                ->nullable();
            $table->unsignedBigInteger(IReportAlmatyBusinessMFO::CompanyUserId)
                ->nullable();
            $table->uuid(IReportAlmatyBusinessMFO::CompanyId)
                ->nullable();
            $table->unsignedBigInteger(IReportAlmatyBusinessMFO::LastEditorId)
                ->nullable();
            $table->longText(IReportAlmatyBusinessMFO::LastFailComment)
                ->nullable();
            $table->boolean(IReportAlmatyBusinessMFO::IsEdited)
                ->default(false);
            $table->timestamps();

            $table->foreign('report_id')
                ->references('id')
                ->on('government_report_headers');
            $table->foreign(IReportAlmatyBusinessMFO::ProgramDistrictId)
                ->references('id')
                ->on('districts');
            $table->foreign(IReportAlmatyBusinessMFO::CompanyUserId)
                ->references('id')
                ->on('users');
            $table->foreign(IReportAlmatyBusinessMFO::CompanyId)
                ->references('id')
                ->on('organizations');
            $table->foreign(IReportAlmatyBusinessMFO::LastEditorId)
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('government_business_m_f_o_reports');
    }
}

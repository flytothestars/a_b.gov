<?php

use App\Contracts\GovernmentProgramsReports\IReportEnbek;
use App\Contracts\GovernmentProgramsReports\IReportStatuses;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGovernmentEnbekReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('government_enbek_reports', function (Blueprint $table) {
            $table->id();
            $table->uuid(IReportEnbek::ReportId);
            $table->integer(IReportEnbek::Status)
                ->default(IReportStatuses::New);
            $table->unsignedBigInteger(IReportEnbek::Number)
                ->nullable();
            $table->string(IReportEnbek::STB)->nullable();
            $table->string(IReportEnbek::Source)->nullable();
            $table->string(IReportEnbek::CompanyBinIin)->nullable();
            $table->string(IReportEnbek::Borrower)->nullable();
            $table->double(IReportEnbek::Amount, 15, 2)->nullable();
            $table->text(IReportEnbek::Target)->nullable();
            $table->string(IReportEnbek::TypeOfActivityIndustry)->nullable();
            $table->string(IReportEnbek::ADistrictOfTheCity)->nullable();
            $table->integer(IReportEnbek::WorkplacesActual)->nullable();
            $table->integer(IReportEnbek::JobsCreated)->nullable();
            $table->string(IReportEnbek::StartUp)->nullable();
            $table->string(IReportEnbek::ProjectStatus)->nullable();
            $table->double(IReportEnbek::Guarantees, 15, 2)->nullable();
            $table->longText(IReportEnbek::LastFailComment)
                ->nullable();
            $table->uuid(IReportEnbek::ProgramDistrictId)
                ->nullable();
            $table->unsignedBigInteger(IReportEnbek::CompanyUserId)
                ->nullable();
            $table->uuid(IReportEnbek::CompanyId)
                ->nullable();
            $table->unsignedBigInteger(IReportEnbek::LastEditorId)
                ->nullable();
            $table->boolean(IReportEnbek::IsEdited)
                ->default(false);


            $table->timestamps();

            $table->foreign('report_id')
                ->references('id')
                ->on('government_report_headers');
            $table->foreign(IReportEnbek::ProgramDistrictId)
                ->references('id')
                ->on('districts');
            $table->foreign(IReportEnbek::CompanyUserId)
                ->references('id')
                ->on('users');
            $table->foreign(IReportEnbek::CompanyId)
                ->references('id')
                ->on('organizations');
            $table->foreign(IReportEnbek::LastEditorId)
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
        Schema::dropIfExists('government_enbek_reports');
    }
}

<?php

use App\Contracts\GovernmentProgramsReports\IReportQolday;
use App\Contracts\GovernmentProgramsReports\IReportStatuses;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGovernmentQoldayReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('government_qolday_reports', function (Blueprint $table) {
            $table->id();
            $table->uuid(IReportQolday::ReportId);
            $table->integer(IReportQolday::Status)
                ->default(IReportStatuses::New);
            $table->integer(IReportQolday::NumberOfConsultations)->nullable();
            $table->integer(IReportQolday::DevelopedPlans)->nullable();
            $table->integer(IReportQolday::AccompaniedProjects)->nullable();
            $table->integer(IReportQolday::SumOfProjects)->nullable();
            $table->integer(IReportQolday::PermitsReceived)->nullable();
            $table->integer(IReportQolday::NumberOfListeners)->nullable();
            $table->unsignedBigInteger(IReportQolday::LastEditorId)
                ->nullable();
            $table->longText(IReportQolday::LastFailComment)
                ->nullable();
            $table->boolean(IReportQolday::IsEdited)
                ->default(false);
            $table->timestamps();

            $table->foreign('report_id')
                ->references('id')
                ->on('government_report_headers');
            $table->foreign(IReportQolday::LastEditorId)
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
        Schema::dropIfExists('government_qolday_reports');
    }
}

<?php

use App\Contracts\GovernmentProgramsReports\IReportTypeAlmatyFinance;
use App\Contracts\GovernmentProgramsReports\IReportStatuses;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGovernmentAlmatyFinanceReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('government_almaty_finance_reports', function (Blueprint $table) {
            $table->id();
            $table->uuid(IReportTypeAlmatyFinance::ReportId);
            $table->integer(IReportTypeAlmatyFinance::Status)
                ->default(IReportStatuses::New);
            $table->unsignedBigInteger(IReportTypeAlmatyFinance::Number)
                ->nullable();
            $table->string(IReportTypeAlmatyFinance::EntrepreneurName)->nullable();
            $table->string(IReportTypeAlmatyFinance::CompanyBinIin)->nullable();
            $table->string(IReportTypeAlmatyFinance::SubjectSize)->nullable();
            $table->string(IReportTypeAlmatyFinance::PlaceOfImplementation)->nullable();
            $table->double(IReportTypeAlmatyFinance::CreditAmount, 15, 2)->nullable();
            $table->double(IReportTypeAlmatyFinance::LoanRate, 10, 2)->nullable();
            $table->integer(IReportTypeAlmatyFinance::CurrentWorkPlace)->nullable();
            $table->integer(IReportTypeAlmatyFinance::CreatedWorkPlace)->nullable();
            $table->string(IReportTypeAlmatyFinance::BranchOfActivity)->nullable();
            $table->text(IReportTypeAlmatyFinance::OKED)->nullable();
            $table->text(IReportTypeAlmatyFinance::BusinessOfImplementation)->nullable();
            $table->string(IReportTypeAlmatyFinance::PurposeOfTheLoan)->nullable();
            $table->string(IReportTypeAlmatyFinance::ProjectStatus)->nullable();
            $table->date(IReportTypeAlmatyFinance::DateOfIssue)->nullable();
            $table->string(IReportTypeAlmatyFinance::LegalAddressOfTheCompany)->nullable();
            $table->string(IReportTypeAlmatyFinance::FullNameOfTheHead)->nullable();
            $table->string(IReportTypeAlmatyFinance::Contacts)->nullable();
            $table->uuid(IReportTypeAlmatyFinance::ProgramDistrictId)
                ->nullable();
            $table->unsignedBigInteger(IReportTypeAlmatyFinance::CompanyUserId)
                ->nullable();
            $table->uuid(IReportTypeAlmatyFinance::CompanyId)
                ->nullable();
            $table->unsignedBigInteger(IReportTypeAlmatyFinance::LastEditorId)
                ->nullable();
            $table->longText(IReportTypeAlmatyFinance::LastFailComment)
                ->nullable();
            $table->boolean(IReportTypeAlmatyFinance::IsEdited)
                ->default(false);

            $table->timestamps();
            $table->foreign('report_id')
                ->references('id')
                ->on('government_report_headers');
            $table->foreign(IReportTypeAlmatyFinance::ProgramDistrictId)
                ->references('id')
                ->on('districts');
            $table->foreign(IReportTypeAlmatyFinance::CompanyUserId)
                ->references('id')
                ->on('users');
            $table->foreign(IReportTypeAlmatyFinance::CompanyId)
                ->references('id')
                ->on('organizations');
            $table->foreign(IReportTypeAlmatyFinance::LastEditorId)
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
        Schema::dropIfExists('government_almaty_finance_reports');
    }
}

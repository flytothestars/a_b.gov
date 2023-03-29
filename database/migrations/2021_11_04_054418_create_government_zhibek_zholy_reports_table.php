<?php

use App\Contracts\GovernmentProgramsReports\IReportAlmatyBusinessZhibekZholy;
use App\Contracts\GovernmentProgramsReports\IReportStatuses;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGovernmentZhibekZholyReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('government_zhibek_zholy_reports', function (Blueprint $table) {
            $table->id();
            $table->uuid(IReportAlmatyBusinessZhibekZholy::ReportId);
            $table->integer(IReportAlmatyBusinessZhibekZholy::Status)
                ->default(IReportStatuses::New);
            $table->unsignedBigInteger(IReportAlmatyBusinessZhibekZholy::Number)
                ->nullable();
            $table->string(IReportAlmatyBusinessZhibekZholy::Program)->nullable();
            $table->string(IReportAlmatyBusinessZhibekZholy::NameOfTheBank)->nullable();
            $table->string(IReportAlmatyBusinessZhibekZholy::Region)->nullable();
            $table->string(IReportAlmatyBusinessZhibekZholy::BorrowerName)->nullable();
            $table->string(IReportAlmatyBusinessZhibekZholy::LegalStatus)->nullable();
            $table->date(IReportAlmatyBusinessZhibekZholy::LoanIssueDate)->nullable();
            $table->integer(IReportAlmatyBusinessZhibekZholy::LoanTerm)->nullable();
            $table->double(IReportAlmatyBusinessZhibekZholy::LoanAmount, 15, 2)->nullable();
            $table->double(IReportAlmatyBusinessZhibekZholy::ApprovedLoanAmount, 15, 2)->nullable();
            $table->double(IReportAlmatyBusinessZhibekZholy::FundsOwnAmount, 15, 2)->nullable();
            $table->double(IReportAlmatyBusinessZhibekZholy::ActualAmount, 15, 2)->nullable();
            $table->double(IReportAlmatyBusinessZhibekZholy::FundActualAmount, 15, 2)->nullable();
            $table->double(IReportAlmatyBusinessZhibekZholy::BankActualAmount, 15, 2)->nullable();
            $table->integer(IReportAlmatyBusinessZhibekZholy::PrincipalRepaymentPeriod)->nullable();
            $table->integer(IReportAlmatyBusinessZhibekZholy::RemunerationPaymentPeriod)->nullable();
            $table->double(IReportAlmatyBusinessZhibekZholy::LoanInterestRate, 10, 2)->nullable();
            $table->double(IReportAlmatyBusinessZhibekZholy::EffectiveLoanRate, 10, 2)->nullable();
            $table->string(IReportAlmatyBusinessZhibekZholy::LoanObject)->nullable();
            $table->string(IReportAlmatyBusinessZhibekZholy::PurposeOfBorrowedFunds)->nullable();
            $table->string(IReportAlmatyBusinessZhibekZholy::PlaceOfImplementation)->nullable();
            $table->string(IReportAlmatyBusinessZhibekZholy::OKED)->nullable();
            $table->text(IReportAlmatyBusinessZhibekZholy::SubSectorOKED)->nullable();
            $table->integer(IReportAlmatyBusinessZhibekZholy::NewWorkplaces)->nullable();
            $table->string(IReportAlmatyBusinessZhibekZholy::AuthorizedBankDecisionNo)->nullable();
            $table->date(IReportAlmatyBusinessZhibekZholy::AuthorizedBankDecisionDate)->nullable();
            $table->string(IReportAlmatyBusinessZhibekZholy::LoanAgreementNo)->nullable();
            $table->date(IReportAlmatyBusinessZhibekZholy::LoanAgreementDate)->nullable();
            $table->string(IReportAlmatyBusinessZhibekZholy::CompanyBinIin)->nullable();
            $table->string(IReportAlmatyBusinessZhibekZholy::BusinessProject)->nullable();

            $table->uuid(IReportAlmatyBusinessZhibekZholy::ProgramCityId)
                ->nullable();
            $table->boolean(IReportAlmatyBusinessZhibekZholy::IsRegionProject)
                ->nullable();
            $table->unsignedBigInteger(IReportAlmatyBusinessZhibekZholy::CompanyUserId)
                ->nullable();
            $table->uuid(IReportAlmatyBusinessZhibekZholy::CompanyId)
                ->nullable();
            $table->unsignedBigInteger(IReportAlmatyBusinessZhibekZholy::LastEditorId)
                ->nullable();
            $table->boolean(IReportAlmatyBusinessZhibekZholy::IsEdited)
                ->default(false);

            $table->longText(IReportAlmatyBusinessZhibekZholy::LastFailComment)
                ->nullable();
            $table->timestamps();
            $table->foreign('report_id')
                ->references('id')
                ->on('government_report_headers');
            $table->foreign(IReportAlmatyBusinessZhibekZholy::ProgramCityId)
                ->references('id')
                ->on('cities');
            $table->foreign(IReportAlmatyBusinessZhibekZholy::CompanyUserId)
                ->references('id')
                ->on('users');
            $table->foreign(IReportAlmatyBusinessZhibekZholy::CompanyId)
                ->references('id')
                ->on('organizations');
            $table->foreign(IReportAlmatyBusinessZhibekZholy::LastEditorId)
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
        Schema::dropIfExists('government_zhibek_zholy_reports');
    }
}

<?php

use App\Contracts\GovernmentProgramsReports\IReportDKBGuarantee;
use App\Contracts\GovernmentProgramsReports\IReportStatuses;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGovernmentGuaranteeReportsTable extends Migration
{
      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up()
      {
            Schema::create(
                  'government_guarantee_reports',
                  function (Blueprint $table) {
                        $table->id();
                        $table->uuid(IReportDKBGuarantee::ReportId);
                        $table->integer(IReportDKBGuarantee::Status)
                              ->default(IReportStatuses::New);
                        $table->unsignedBigInteger(IReportDKBGuarantee::Number)
                              ->nullable();
                        $table->string(IReportDKBGuarantee::CompanyType)
                              ->nullable();
                        $table->string(IReportDKBGuarantee::Name)
                              ->nullable();
                        $table->text(IReportDKBGuarantee::ProjectDescription)
                              ->nullable();
                        $table->text(IReportDKBGuarantee::LoanTarget)
                              ->nullable();
                        $table->date(IReportDKBGuarantee::BankIssueDate)
                              ->nullable();
                        $table->date(IReportDKBGuarantee::BankUODecisionDate)
                              ->nullable();
                        $table->string(IReportDKBGuarantee::Industry)
                              ->nullable();
                        $table->string(IReportDKBGuarantee::SubIndustry)
                              ->nullable();
                        $table->string(IReportDKBGuarantee::LenderBank)
                              ->nullable();
                        $table->double(IReportDKBGuarantee::LoanAmount, 15, 2)
                              ->nullable();
                        $table->double(IReportDKBGuarantee::LoanGuarantee, 15, 2)
                              ->nullable();
                        $table->unsignedInteger(IReportDKBGuarantee::LoanGuaranteePeriod)
                              ->nullable();
                        $table->date(IReportDKBGuarantee::FoundationDecisionDate)
                              ->nullable();
                        $table->date(IReportDKBGuarantee::SignGuaranteeAgreementDate)
                              ->nullable();
                        $table->string(IReportDKBGuarantee::GuaranteeAgreementNumber)
                              ->nullable();
                        $table->unsignedInteger(IReportDKBGuarantee::CurrentEmployeesCount)
                              ->nullable();
                        $table->unsignedInteger(IReportDKBGuarantee::NewJobsPlacesCount)
                              ->nullable();
                        $table->boolean(IReportDKBGuarantee::WomenEntrepreneurshipCompliance)
                              ->nullable();
                        $table->date(IReportDKBGuarantee::CompanyHeadDateOfBirth)
                              ->nullable();
                        $table->string(IReportDKBGuarantee::ProjectRegion)
                              ->nullable();
                        $table->string(IReportDKBGuarantee::ProjectLocation)
                              ->nullable();
                        $table->boolean(IReportDKBGuarantee::ProjectLocationInMonocity)
                              ->nullable();
                        $table->string(IReportDKBGuarantee::DKBProgram)
                              ->nullable();
                        $table->unsignedInteger(IReportDKBGuarantee::ProgramDirection)
                              ->nullable();
                        $table->string(IReportDKBGuarantee::FundingSource)
                              ->nullable();
                        $table->double(IReportDKBGuarantee::LoanPercent, 10, 2)
                              ->nullable();
                        $table->string(IReportDKBGuarantee::GuaranteeKind)
                              ->nullable();
                        $table->date(IReportDKBGuarantee::GuaranteeEndDate)
                              ->nullable();
                        $table->boolean(IReportDKBGuarantee::GuaranteeExpired)
                              ->nullable();
                        $table->string(IReportDKBGuarantee::ProjectStatus)
                              ->nullable();
                        $table->date(IReportDKBGuarantee::GuaranteeExpireDate)
                              ->nullable();
                        $table->float(IReportDKBGuarantee::BankPayOnDemandAmount)
                              ->nullable();
                        $table->string(IReportDKBGuarantee::CompanyBinIin)
                              ->nullable();
                        $table->string(IReportDKBGuarantee::RFManagerFullName)
                              ->nullable();
                        $table->unsignedInteger(IReportDKBGuarantee::Year)
                              ->nullable();
                        $table->unsignedInteger(IReportDKBGuarantee::Quarter)
                              ->nullable();
                        $table->boolean(IReportDKBGuarantee::PortfolioGuarantee)
                              ->nullable();
                        $table->string(IReportDKBGuarantee::PGCommissionRegistrationDate)
                              ->nullable();
                        $table->uuid(IReportDKBGuarantee::ProgramCityId)
                              ->nullable();
                        $table->uuid(IReportDKBGuarantee::ProgramDistrictId)
                              ->nullable();
                        $table->boolean(IReportDKBGuarantee::IsRegionProject)
                              ->nullable();
                        $table->unsignedBigInteger(IReportDKBGuarantee::CompanyUserId)
                              ->nullable();
                        $table->unsignedBigInteger(IReportDKBGuarantee::LastEditorId)
                              ->nullable();
                        $table->boolean(IReportDKBGuarantee::IsEdited)
                              ->default(false);
                        $table->longText(IReportDKBGuarantee::LastFailComment)
                              ->nullable();
                        $table->timestamps();

                        $table->foreign('report_id')
                              ->references('id')
                              ->on('government_report_headers');
                        $table->foreign(IReportDKBGuarantee::ProgramCityId)
                              ->references('id')
                              ->on('cities');
                        $table->foreign(IReportDKBGuarantee::ProgramDistrictId)
                              ->references('id')
                              ->on('districts');
                        $table->foreign(IReportDKBGuarantee::CompanyUserId)
                              ->references('id')
                              ->on('users');
                        $table->foreign(IReportDKBGuarantee::LastEditorId)
                              ->references('id')
                              ->on('users');
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
            Schema::dropIfExists('government_guarantee_reports');
      }
}

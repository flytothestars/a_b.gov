<?php

use App\Contracts\GovernmentProgramsReports\IReportDKBSubsidies;
use App\Contracts\GovernmentProgramsReports\IReportStatuses;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGovernmentSubsidiesReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('government_subsidies_reports', function (Blueprint $table) {
            $table->id();
            $table->uuid(IReportDKBSubsidies::ReportId);
            $table->integer(IReportDKBSubsidies::Status)
                ->default(IReportStatuses::New);
            $table->unsignedBigInteger(IReportDKBSubsidies::Number)
                ->nullable();

            $table->string(IReportDKBSubsidies::STBName)
                ->nullable();
            $table->string(IReportDKBSubsidies::EntrepreneurSName)->nullable();
            $table->string(IReportDKBSubsidies::CompanyBinIin)->nullable();
            $table->string(IReportDKBSubsidies::SubjectSize)->nullable();
            $table->string(IReportDKBSubsidies::District)->nullable();
            $table->double(IReportDKBSubsidies::CreditAmount, 15, 2)->nullable();
            $table->double(IReportDKBSubsidies::LoanRate, 10, 2)->nullable();
            $table->double(IReportDKBSubsidies::Subsidies, 10, 2)->nullable();
            $table->double(IReportDKBSubsidies::TheAmountOfThePlannedSubsidyUntil, 15, 2)->nullable();
            $table->integer(IReportDKBSubsidies::CurrentNumberOfWorkPlaces)->nullable();
            $table->integer(IReportDKBSubsidies::NumberOfCreatedWorkplaces)->nullable();
            $table->string(IReportDKBSubsidies::IndustryOfActivity)->nullable();
            $table->text(IReportDKBSubsidies::OKED)->nullable();
            $table->text(IReportDKBSubsidies::PurposeOfTheLoan)->nullable();
            $table->string(IReportDKBSubsidies::DirectionByProgram)->nullable();
            $table->string(IReportDKBSubsidies::TheEssenceOfTheQuestionIsNewProlongation)->nullable();
            $table->date(IReportDKBSubsidies::dateOfRegistrationOfTheApplication)->nullable();
            $table->string(IReportDKBSubsidies::ProtocolNumberOfTheFundMAPM)->nullable();
            $table->date(IReportDKBSubsidies::dateOfTheMinutesOfTheFundMAPM)->nullable();
            $table->date(IReportDKBSubsidies::ExpirationDateOfRKSFund)->nullable();
            $table->date(IReportDKBSubsidies::DateOfSendingTheLetterToSTB)->nullable();
            $table->string(IReportDKBSubsidies::YurCompanyAddress)->nullable();
            $table->string(IReportDKBSubsidies::FullNameOfTheHead)->nullable();
            $table->string(IReportDKBSubsidies::Contacts)->nullable();

            $table->longText(IReportDKBSubsidies::LastFailComment)
                ->nullable();
            $table->uuid(IReportDKBSubsidies::ProgramDistrictId)
                ->nullable();
            $table->unsignedBigInteger(IReportDKBSubsidies::CompanyUserId)
                ->nullable();
            $table->uuid(IReportDKBSubsidies::CompanyId)
                ->nullable();
            $table->unsignedBigInteger(IReportDKBSubsidies::LastEditorId)
                ->nullable();
            $table->boolean(IReportDKBSubsidies::IsEdited)
                ->default(false);

            $table->timestamps();

            $table->foreign('report_id')
                ->references('id')
                ->on('government_report_headers');
            $table->foreign(IReportDKBSubsidies::ProgramDistrictId)
                ->references('id')
                ->on('districts');
            $table->foreign(IReportDKBSubsidies::CompanyUserId)
                ->references('id')
                ->on('users');
            $table->foreign(IReportDKBSubsidies::CompanyId)
                ->references('id')
                ->on('organizations');
            $table->foreign(IReportDKBSubsidies::LastEditorId)
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
        Schema::dropIfExists('government_subsidies_reports');
    }
}

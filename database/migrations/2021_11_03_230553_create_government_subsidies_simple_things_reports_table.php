<?php

use App\Contracts\GovernmentProgramsReports\IReportDKBSubsidiesSimpleThings;
use App\Contracts\GovernmentProgramsReports\IReportStatuses;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGovernmentSubsidiesSimpleThingsReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('government_simple_things_reports', function (Blueprint $table) {
            $table->id();
            $table->uuid(IReportDKBSubsidiesSimpleThings::ReportId);
            $table->integer(IReportDKBSubsidiesSimpleThings::Status)
                ->default(IReportStatuses::New);
            $table->unsignedBigInteger(IReportDKBSubsidiesSimpleThings::Number)
                ->nullable();
            $table->string(IReportDKBSubsidiesSimpleThings::STBName)
                ->nullable();
            $table->string(IReportDKBSubsidiesSimpleThings::EntrepreneurSName)->nullable();
            $table->string(IReportDKBSubsidiesSimpleThings::CompanyBinIin)->nullable();
            $table->string(IReportDKBSubsidiesSimpleThings::SubjectSize)->nullable();
            $table->string(IReportDKBSubsidiesSimpleThings::District)->nullable();
            $table->double(IReportDKBSubsidiesSimpleThings::CreditAmount, 15, 2)->nullable();
            $table->double(IReportDKBSubsidiesSimpleThings::LoanRate, 10, 2)->nullable();
            $table->double(IReportDKBSubsidiesSimpleThings::Subsidies, 10, 2)->nullable();
            $table->double(IReportDKBSubsidiesSimpleThings::TheAmountOfThePlannedSubsidyUntil, 15, 2)->nullable();
            $table->integer(IReportDKBSubsidiesSimpleThings::CurrentNumberOfWorkPlaces)->nullable();
            $table->integer(IReportDKBSubsidiesSimpleThings::NumberOfCreatedWorkplaces)->nullable();
            $table->string(IReportDKBSubsidiesSimpleThings::IndustryOfActivity)->nullable();
            $table->text(IReportDKBSubsidiesSimpleThings::OKED)->nullable();
            $table->text(IReportDKBSubsidiesSimpleThings::PurposeOfTheLoan)->nullable();
            $table->string(IReportDKBSubsidiesSimpleThings::DirectionByProgram)->nullable();
            $table->string(IReportDKBSubsidiesSimpleThings::TheEssenceOfTheQuestionIsNewProlongation)->nullable();
            $table->date(IReportDKBSubsidiesSimpleThings::dateOfRegistrationOfTheApplication)->nullable();
            $table->string(IReportDKBSubsidiesSimpleThings::ProtocolNumberOfTheFundMAPM)->nullable();
            $table->date(IReportDKBSubsidiesSimpleThings::dateOfTheMinutesOfTheFundMAPM)->nullable();
            $table->date(IReportDKBSubsidiesSimpleThings::ExpirationDateOfRKSFund)->nullable();
            $table->date(IReportDKBSubsidiesSimpleThings::DateOfSendingTheLetterToSTB)->nullable();
            $table->string(IReportDKBSubsidiesSimpleThings::YurCompanyAddress)->nullable();
            $table->string(IReportDKBSubsidiesSimpleThings::FullNameOfTheHead)->nullable();
            $table->string(IReportDKBSubsidiesSimpleThings::Contacts)->nullable();

            $table->longText(IReportDKBSubsidiesSimpleThings::LastFailComment)
                ->nullable();
            $table->uuid(IReportDKBSubsidiesSimpleThings::ProgramDistrictId)
                ->nullable();
            $table->unsignedBigInteger(IReportDKBSubsidiesSimpleThings::CompanyUserId)
                ->nullable();
            $table->uuid(IReportDKBSubsidiesSimpleThings::CompanyId)
                ->nullable();
            $table->unsignedBigInteger(IReportDKBSubsidiesSimpleThings::LastEditorId)
                ->nullable();
            $table->boolean(IReportDKBSubsidiesSimpleThings::IsEdited)
                ->default(false);

            $table->timestamps();

            $table->foreign('report_id')
                ->references('id')
                ->on('government_report_headers');
            $table->foreign(IReportDKBSubsidiesSimpleThings::ProgramDistrictId)
                ->references('id')
                ->on('districts');
            $table->foreign(IReportDKBSubsidiesSimpleThings::CompanyUserId)
                ->references('id')
                ->on('users');
            $table->foreign(IReportDKBSubsidiesSimpleThings::CompanyId)
                ->references('id')
                ->on('organizations');
            $table->foreign(IReportDKBSubsidiesSimpleThings::LastEditorId)
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
        Schema::dropIfExists('government_simple_things_reports');
    }
}

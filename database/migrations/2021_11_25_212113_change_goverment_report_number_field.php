<?php

use App\Contracts\GovernmentProgramsReports\IReportAlmatyBusinessMFO;
use App\Contracts\GovernmentProgramsReports\IReportAlmatyBusinessZhibekZholy;
use App\Contracts\GovernmentProgramsReports\IReportDKBGuarantee;
use App\Contracts\GovernmentProgramsReports\IReportDKBSubsidies;
use App\Contracts\GovernmentProgramsReports\IReportDKBSubsidiesSimpleThings;
use App\Contracts\GovernmentProgramsReports\IReportEnbek;
use App\Contracts\GovernmentProgramsReports\IReportTypeAlmatyFinance;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeGovermentReportNumberField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    final public function up(): void
    {
        Schema::table(
            'government_almaty_finance_reports',
            function (Blueprint $table)
            {
                $table->string(IReportTypeAlmatyFinance::Number)
                      ->nullable()
                      ->change()
                ;
            }
        );
        Schema::table(
            'government_business_m_f_o_reports',
            function (Blueprint $table)
            {
                $table->string(IReportAlmatyBusinessMFO::Number)
                      ->nullable()
                      ->change()
                ;
            }
        );
        Schema::table(
            'government_enbek_reports',
            function (Blueprint $table)
            {
                $table->string(IReportEnbek::Number)
                      ->nullable()
                      ->change()
                ;
            }
        );
        Schema::table(
            'government_guarantee_reports',
            function (Blueprint $table)
            {
                $table->string(IReportDKBGuarantee::Number)
                      ->nullable()
                      ->change()
                ;
            }
        );
        Schema::table(
            'government_simple_things_reports',
            function (Blueprint $table)
            {
                $table->string(IReportDKBSubsidiesSimpleThings::Number)
                      ->nullable()
                      ->change()
                ;
            }
        );
        Schema::table(
            'government_subsidies_reports',
            function (Blueprint $table)
            {
                $table->string(IReportDKBSubsidies::Number)
                      ->nullable()
                      ->change()
                ;
            }
        );
        Schema::table(
            'government_zhibek_zholy_reports',
            function (Blueprint $table)
            {
                $table->string(IReportAlmatyBusinessZhibekZholy::Number)
                      ->nullable()
                      ->change()
                ;
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    final public function down(): void
    {
        Schema::table(
            'government_almaty_finance_reports',
            function (Blueprint $table)
            {
                $table->unsignedBigInteger(IReportTypeAlmatyFinance::Number)
                      ->nullable()
                      ->change()
                ;
            }
        );
        Schema::table(
            'government_business_m_f_o_reports',
            function (Blueprint $table)
            {
                $table->unsignedBigInteger(IReportAlmatyBusinessMFO::Number)
                      ->nullable()
                      ->change()
                ;
            }
        );
        Schema::table(
            'government_enbek_reports',
            function (Blueprint $table)
            {
                $table->unsignedBigInteger(IReportEnbek::Number)
                      ->nullable()
                      ->change()
                ;
            }
        );
        Schema::table(
            'government_guarantee_reports',
            function (Blueprint $table)
            {
                $table->unsignedBigInteger(IReportDKBGuarantee::Number)
                      ->nullable()
                      ->change()
                ;
            }
        );
        Schema::table(
            'government_simple_things_reports',
            function (Blueprint $table)
            {
                $table->unsignedBigInteger(IReportDKBSubsidiesSimpleThings::Number)
                      ->nullable()
                      ->change()
                ;
            }
        );
        Schema::table(
            'government_subsidies_reports',
            function (Blueprint $table)
            {
                $table->unsignedBigInteger(IReportDKBSubsidies::Number)
                      ->nullable()
                      ->change()
                ;
            }
        );
        Schema::table(
            'government_zhibek_zholy_reports',
            function (Blueprint $table)
            {
                $table->unsignedBigInteger(IReportAlmatyBusinessZhibekZholy::Number)
                      ->nullable()
                      ->change()
                ;
            }
        );
    }
}

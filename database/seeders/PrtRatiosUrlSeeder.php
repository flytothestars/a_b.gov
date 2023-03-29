<?php

namespace Database\Seeders;

use App\Contracts\Taldau\ITaldauApiUrlContract;
use App\Models\Taldau\TaldauApiUrl;
use App\Repositories\Enums\Reports\IReportTypeEnum;
use App\Repositories\Enums\Reports\Prt\IPrtReport;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class PrtRatiosUrlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    final public function run(): void
    {
        $ratios = [
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741927,807855,447346&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::MainCapitalInvestmentsFact,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701852&p_keyword=&p_period_id=8&p_measure_id=7&p_term_id=741880&p_terms=741880,741917,2695732,447346&p_dicIds=68,776,848,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::IfoProcessingIndustrialDynamic,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701852&p_keyword=&p_period_id=8&p_measure_id=7&p_term_id=741880&p_terms=741880,741917,2695732,447346&p_dicIds=68,776,848,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::MainCapitalInvestmentsInvestmentsDynamic,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=4&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::Top5IndustryIfoUp,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=4&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::IndustryIfoIndustryIndustrial,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=4&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::IndustryIfoIndustryForestAndFishing,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=4&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::IndustryIfoIndustryBuild,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=4&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::IndustryIfoIndustryTradeAndRepair,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=4&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::IndustryIfoIndustryLogistic,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=4&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::IndustryIfoIndustryAccommodationAndFood,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=4&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::IndustryIfoIndustryInformAndCommunication,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=4&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::IndustryIfoIndustryFinanceAndInsurance,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=4&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::IndustryIfoIndustryFinanceAndInsurance,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=4&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::IndustryIfoIndustryRealEstate,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=4&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::IndustryIfoIndustryScience,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=4&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::IndustryIfoIndustryAdministrateAndSupport,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=4&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::IndustryIfoIndustryAdministrateAndSupport,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=4&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::IndustryIfoIndustryAdministrateAndSupport,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=4&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::IndustryIfoIndustryAdministrateAndSupport,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=4&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::IndustryIfoIndustryGovernmentAndDefence,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=4&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::IndustryIfoIndustryEducation,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=4&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::IndustryIfoIndustryEducation,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=4&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::IndustryIfoIndustryHealthCare,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=4&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::IndustryIfoIndustryHealthCare,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=4&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::IndustryIfoIndustryArtsAndEntertainment,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=4&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::IndustryIfoIndustryArtsAndEntertainment,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=4&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::IndustryIfoIndustryOther,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=4&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::IndustryIfoIndustryHouseHold,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=4&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::IndustryIfoIndustryOther,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=4&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::IndustryIfoIndustryExtraterritorial,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=4&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::IndustryIfoIndustryMining,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=4&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::IndustryIfoIndustryManufacture,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=4&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::IndustryIfoIndustrySupply,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=4&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::IndustryIfoIndustryWaste,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=4&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::IndustryIfoIndustryWaste,
            ],

            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::Top5IndustryInvestIndustrial,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::Top5IndustryInvestForestAndFishing,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::Top5IndustryInvestBuild,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::Top5IndustryInvestTradeAndRepair,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::Top5IndustryInvestLogistic,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::Top5IndustryInvestAccommodationAndFood,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::Top5IndustryInvestInformAndCommunication,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::Top5IndustryInvestFinanceAndInsurance,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::Top5IndustryInvestRealEstate,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::Top5IndustryInvestScience,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::Top5IndustryInvestAdministrateAndSupport,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::Top5IndustryInvestGovernmentAndDefence,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::Top5IndustryInvestEducation,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::Top5IndustryInvestHealthCare,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::Top5IndustryInvestArtsAndEntertainment,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::Top5IndustryInvestArtsAndEntertainment,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::Top5IndustryInvestOther,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::Top5IndustryInvestHouseHold,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::Top5IndustryInvestExtraterritorial,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::Top5IndustryInvestMining,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::Top5IndustryInvestManufacture,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::Top5IndustryInvestSupply,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypePTR,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IPrtReport::Top5IndustryInvestWaste,
            ],
        ];

        foreach ($ratios as $key => $ratio) {
            $ratios[ $key ][ ITaldauApiUrlContract::FIELD_ID ] = Uuid::uuid4();
        }

        TaldauApiUrl::insert($ratios);
    }
}

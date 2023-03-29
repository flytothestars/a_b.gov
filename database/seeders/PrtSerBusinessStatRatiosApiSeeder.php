<?php

namespace Database\Seeders;

use App\Contracts\Taldau\ITaldauApiUrlContract;
use App\Models\Taldau\TaldauApiUrl;
use App\Repositories\Enums\Reports\Ser\IBusinessStatisticsRatioEnum;
use App\Repositories\Enums\Reports\IReportTypeEnum;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class PrtSerBusinessStatRatiosApiSeeder extends Seeder
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
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701159&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,741885,741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumber,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701160&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,741885,741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumber,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701159&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryForestAndFishingId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryForestAndFishing,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701159&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryMiningId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryMining,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701159&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryManufactureId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryManufacture,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701159&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustrySupplyId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustrySupply,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701159&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryWasteId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryWaste,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701159&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryBuildId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryBuild,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701159&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryTradeAndRepairId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryTradeAndRepair,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701159&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryLogisticId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryLogistic,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701159&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryAccommodationAndFoodId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryAccommodationAndFood,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701159&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryInformAndCommunicationId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryInformAndCommunication,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701159&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryFinanceAndInsuranceId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryFinanceAndInsurance,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701159&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryRealEstateId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryRealEstate,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701159&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryScienceId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryScience,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701159&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryAdministrateAndSupportId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryAdministrateAndSupport,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701159&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryGovernmentAndDefenceId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryGovernmentAndDefence,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701159&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryEducationId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryEducation,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701159&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryHealthCareId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryHealthCare,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701159&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryArtsAndEntertainmentId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryArtsAndEntertainment,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701159&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryOtherId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryOther,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701159&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryHouseHoldId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryHouseHold,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701159&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryExtraterritorialId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryExtraterritorial,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701159&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,741885,19123,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberBySizeSmall,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701159&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,741885,19132,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberBySizeMedium,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701159&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,741885,19137,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberBySizeLarge,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701160&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryForestAndFishingId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryForestAndFishing,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701160&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryMiningId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryMining,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701160&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryManufactureId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryManufacture,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701160&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustrySupplyId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustrySupply,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701160&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryWasteId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryWaste,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701160&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryBuildId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryBuild,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701160&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryTradeAndRepairId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryTradeAndRepair,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701160&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryLogisticId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryLogistic,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701160&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryAccommodationAndFoodId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryAccommodationAndFood,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701160&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryInformAndCommunicationId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryInformAndCommunication,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701160&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryFinanceAndInsuranceId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryFinanceAndInsurance,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701160&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryRealEstateId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryRealEstate,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701160&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryScienceId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryScience,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701160&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryAdministrateAndSupportId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryAdministrateAndSupport,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701160&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryGovernmentAndDefenceId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryGovernmentAndDefence,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701160&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryEducationId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryEducation,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701160&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryHealthCareId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryHealthCare,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701160&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryArtsAndEntertainmentId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryArtsAndEntertainment,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701160&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryOtherId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryOther,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701160&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryHouseHoldId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryHouseHold,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701160&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,'
                                                                . IBusinessStatisticsRatioEnum::IndustryExtraterritorialId
                                                                . ',741927,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryExtraterritorial,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701160&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,741885,19123,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberBySizeSmall,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701160&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,741885,19132,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberBySizeMedium,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701160&p_keyword=&p_period_id=8&p_measure_id=5&p_term_id=741880&p_terms=741880,741885,19137,741907,741926,741925&p_dicIds=67,915,90,59,61,277&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportBusinessStatistics,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberBySizeLarge,
            ],
        ];

        foreach ($ratios as $key => $ratio) {
            $ratios[ $key ][ ITaldauApiUrlContract::FIELD_ID ] = Uuid::uuid4();
        }

        TaldauApiUrl::insert($ratios);
    }
}

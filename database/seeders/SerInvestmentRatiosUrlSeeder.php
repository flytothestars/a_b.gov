<?php

namespace Database\Seeders;

use App\Contracts\Taldau\ITaldauApiUrlContract;
use App\Models\Taldau\TaldauApiUrl;
use App\Repositories\Enums\Reports\IReportTypeEnum;
use App\Repositories\Enums\Reports\Ser\IInvestmentReport;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class SerInvestmentRatiosUrlSeeder extends Seeder
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
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741885,808076&p_dicIds=68,1212,681&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::InvestmentSize,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701852&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,2695732,741885&p_dicIds=68,776,848,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::PhysicalVolumeIndex,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=2970832&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741927&p_dicIds=68,90&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::InternalInvestment,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=2970833&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741927&p_dicIds=68,90&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::ExternalInvestment,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741927,807855,'
                                                                . IInvestmentReport::InvestmentVolumeByActivityIds[ IInvestmentReport::InvestmentVolumeByActivityIndustry ]
                                                                . '&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::InvestmentVolumeByActivityIndustry,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741927,807855,'
                                                                . IInvestmentReport::InvestmentVolumeByActivityIds[ IInvestmentReport::InvestmentVolumeByActivityForestAndFishing ]
                                                                . '&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::InvestmentVolumeByActivityForestAndFishing,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741927,807855,'
                                                                . IInvestmentReport::InvestmentVolumeByActivityIds[ IInvestmentReport::InvestmentVolumeByActivityBuild ]
                                                                . '&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::InvestmentVolumeByActivityBuild,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741927,807855,'
                                                                . IInvestmentReport::InvestmentVolumeByActivityIds[ IInvestmentReport::InvestmentVolumeByActivityTradeAndRepair ]
                                                                . '&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::InvestmentVolumeByActivityTradeAndRepair,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741927,807855,'
                                                                . IInvestmentReport::InvestmentVolumeByActivityIds[ IInvestmentReport::InvestmentVolumeByActivityLogistic ]
                                                                . '&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::InvestmentVolumeByActivityLogistic,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741927,807855,'
                                                                . IInvestmentReport::InvestmentVolumeByActivityIds[ IInvestmentReport::InvestmentVolumeByActivityAccommodationAndFood ]
                                                                . '&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::InvestmentVolumeByActivityAccommodationAndFood,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741927,807855,'
                                                                . IInvestmentReport::InvestmentVolumeByActivityIds[ IInvestmentReport::InvestmentVolumeByActivityInformAndCommunication ]
                                                                . '&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::InvestmentVolumeByActivityInformAndCommunication,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741927,807855,'
                                                                . IInvestmentReport::InvestmentVolumeByActivityIds[ IInvestmentReport::InvestmentVolumeByActivityFinanceAndInsurance ]
                                                                . '&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::InvestmentVolumeByActivityFinanceAndInsurance,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741927,807855,'
                                                                . IInvestmentReport::InvestmentVolumeByActivityIds[ IInvestmentReport::InvestmentVolumeByActivityRealEstate ]
                                                                . '&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::InvestmentVolumeByActivityRealEstate,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741927,807855,'
                                                                . IInvestmentReport::InvestmentVolumeByActivityIds[ IInvestmentReport::InvestmentVolumeByActivityScience ]
                                                                . '&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::InvestmentVolumeByActivityScience,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741927,807855,'
                                                                . IInvestmentReport::InvestmentVolumeByActivityIds[ IInvestmentReport::InvestmentVolumeByActivityAdministrateAndSupport ]
                                                                . '&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::InvestmentVolumeByActivityAdministrateAndSupport,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741927,807855,'
                                                                . IInvestmentReport::InvestmentVolumeByActivityIds[ IInvestmentReport::InvestmentVolumeByActivityGovernmentAndDefence ]
                                                                . '&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::InvestmentVolumeByActivityGovernmentAndDefence,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741927,807855,'
                                                                . IInvestmentReport::InvestmentVolumeByActivityIds[ IInvestmentReport::InvestmentVolumeByActivityEducation ]
                                                                . '&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::InvestmentVolumeByActivityEducation,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741927,807855,'
                                                                . IInvestmentReport::InvestmentVolumeByActivityIds[ IInvestmentReport::InvestmentVolumeByActivityHealthCare ]
                                                                . '&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::InvestmentVolumeByActivityHealthCare,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741927,807855,'
                                                                . IInvestmentReport::InvestmentVolumeByActivityIds[ IInvestmentReport::InvestmentVolumeByActivityArtsAndEntertainment ]
                                                                . '&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::InvestmentVolumeByActivityArtsAndEntertainment,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741927,807855,'
                                                                . IInvestmentReport::InvestmentVolumeByActivityIds[ IInvestmentReport::InvestmentVolumeByActivityOther ]
                                                                . '&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::InvestmentVolumeByActivityOther,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741885,808076&p_dicIds=68,1212,681&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::InvestmentByDistrict,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,'
                                                                . IInvestmentReport::InvestmentBySizeOfEnterprisesIds[ IInvestmentReport::InvestmentBySizeOfEnterprisesSmall ]
                                                                . ',807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::InvestmentBySizeOfEnterprisesSmall,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,'
                                                                . IInvestmentReport::InvestmentBySizeOfEnterprisesIds[ IInvestmentReport::InvestmentBySizeOfEnterprisesMedium ]
                                                                . ',807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::InvestmentBySizeOfEnterprisesMedium,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,'
                                                                . IInvestmentReport::InvestmentBySizeOfEnterprisesIds[ IInvestmentReport::InvestmentBySizeOfEnterprisesLarge ]
                                                                . ',807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::InvestmentBySizeOfEnterprisesLarge,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=7&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,741927,741885,'
                                                                . IInvestmentReport::InvestmentByCostTypeIds[ IInvestmentReport::InvestmentByCostTypeBuilding ]
                                                                . '&p_dicIds=68,776,90,3028,4043&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::InvestmentByCostTypeBuilding,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=7&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,741927,741885,'
                                                                . IInvestmentReport::InvestmentByCostTypeIds[ IInvestmentReport::InvestmentByCostTypeFarm ]
                                                                . '&p_dicIds=68,776,90,3028,4043&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::InvestmentByCostTypeFarm,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=7&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,741927,741885,'
                                                                . IInvestmentReport::InvestmentByCostTypeIds[ IInvestmentReport::InvestmentByCostTypeStockRaising ]
                                                                . '&p_dicIds=68,776,90,3028,4043&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::InvestmentByCostTypeStockRaising,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=7&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,741927,741885,'
                                                                . IInvestmentReport::InvestmentByCostTypeIds[ IInvestmentReport::InvestmentByCostTypeOtherCapital ]
                                                                . '&p_dicIds=68,776,90,3028,4043&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::InvestmentByCostTypeOtherCapital,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=7&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,741927,741885,'
                                                                . IInvestmentReport::InvestmentByCostTypeIds[ IInvestmentReport::InvestmentByCostTypeMachinery ]
                                                                . '&p_dicIds=68,776,90,3028,4043&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::InvestmentByCostTypeMachinery,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=7&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,741927,741885,'
                                                                . IInvestmentReport::InvestmentByCostTypeIds[ IInvestmentReport::InvestmentByCostTypeIt ]
                                                                . '&p_dicIds=68,776,90,3028,4043&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::InvestmentByCostTypeIt,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=7&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,741927,741885,'
                                                                . IInvestmentReport::InvestmentByCostTypeIds[ IInvestmentReport::InvestmentByCostTypeExploration ]
                                                                . '&p_dicIds=68,776,90,3028,4043&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::InvestmentByCostTypeExploration,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=7&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,741927,741885,'
                                                                . IInvestmentReport::InvestmentByCostTypeIds[ IInvestmentReport::InvestmentByCostTypeOther ]
                                                                . '&p_dicIds=68,776,90,3028,4043&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::InvestmentByCostTypeOther,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701852&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,2695732,741885&p_dicIds=68,776,848,3028&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::InvestmentIfoDynamic,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701827&p_keyword=&p_period_id=7&p_measure_id=1&p_term_id=741880&p_terms=741880,741885,'
                                                                . IInvestmentReport::InvestmentGovernmentIds[ IInvestmentReport::InvestmentGovernmentRepublic ]
                                                                . '&p_dicIds=68,1212,459&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::InvestmentGovernmentRepublic,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701827&p_keyword=&p_period_id=7&p_measure_id=1&p_term_id=741880&p_terms=741880,741885,'
                                                                . IInvestmentReport::InvestmentGovernmentIds[ IInvestmentReport::InvestmentGovernmentLocal ]
                                                                . '&p_dicIds=68,1212,459&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::InvestmentGovernmentLocal,
            ],

            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701827&p_keyword=&p_period_id=7&p_measure_id=1&p_term_id=741880&p_terms=741880,741885,451902&p_dicIds=68,1212,459&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::InvestmentOwn,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701827&p_keyword=&p_period_id=7&p_measure_id=1&p_term_id=741880&p_terms=741880,741885,451917&p_dicIds=68,1212,459&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeInvestments,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IInvestmentReport::InvestmentLoan,
            ],
        ];


        foreach ($ratios as $key => $ratio) {
            $ratios[ $key ][ ITaldauApiUrlContract::FIELD_ID ] = Uuid::uuid4();
        }

        TaldauApiUrl::insert($ratios);
    }
}

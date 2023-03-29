<?php

namespace Database\Seeders;

use App\Models\Report\ReportRatio;
use App\Repositories\Enums\Reports\Ser\IBusinessStatisticsRatioEnum;
use App\Repositories\Enums\Reports\IRatioScopeEnum;
use App\Repositories\Enums\Reports\IReportTypeEnum;
use Illuminate\Database\Seeder;

class PrtSerBusinessStatReportSeeder extends Seeder
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
                'id'             => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumber,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumber ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumber,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::OperatingEnterprisesNumber ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryForestAndFishing,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryForestAndFishing ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryMining,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryMining ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryManufacture,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryManufacture ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustrySupply,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustrySupply ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryWaste,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryWaste ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryBuild,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryBuild ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryTradeAndRepair,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryTradeAndRepair ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryLogistic,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryLogistic ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryAccommodationAndFood,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryAccommodationAndFood ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryInformAndCommunication,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryInformAndCommunication ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryFinanceAndInsurance,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryFinanceAndInsurance ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryRealEstate,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryRealEstate ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryScience,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryScience ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryAdministrateAndSupport,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryAdministrateAndSupport ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryGovernmentAndDefence,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryGovernmentAndDefence ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryEducation,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryEducation ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryHealthCare,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryHealthCare ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryArtsAndEntertainment,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryArtsAndEntertainment ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryOther,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryOther ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryHouseHold,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryHouseHold ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryExtraterritorial,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberIndustryExtraterritorial ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberBySizeSmall,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberBySizeSmall ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberBySizeMedium,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberBySizeMedium ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberBySizeLarge,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::RegisteredEnterprisesNumberBySizeLarge ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryForestAndFishing,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryForestAndFishing ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryMining,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryMining ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryManufacture,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryManufacture ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustrySupply,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustrySupply ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryWaste,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryWaste ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryBuild,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryBuild ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryTradeAndRepair,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryTradeAndRepair ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryLogistic,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryLogistic ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryAccommodationAndFood,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryAccommodationAndFood ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryInformAndCommunication,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryInformAndCommunication ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryFinanceAndInsurance,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryFinanceAndInsurance ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryRealEstate,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryRealEstate ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryScience,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryScience ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryAdministrateAndSupport,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryAdministrateAndSupport ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryGovernmentAndDefence,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryGovernmentAndDefence ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryEducation,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryEducation ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryHealthCare,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryHealthCare ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryArtsAndEntertainment,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryArtsAndEntertainment ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryOther,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryOther ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryHouseHold,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryHouseHold ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryExtraterritorial,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberIndustryExtraterritorial ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberBySizeSmall,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberBySizeSmall ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberBySizeMedium,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberBySizeMedium ]
                ),
            ],
            [
                'id'             => IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberBySizeLarge,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportBusinessStatistics,
                'name'           => trans(
                    IBusinessStatisticsRatioEnum::RatioNames[ IBusinessStatisticsRatioEnum::OperatingEnterprisesNumberBySizeLarge ]
                ),
            ],
        ];

        ReportRatio::insert($ratios);
    }
}

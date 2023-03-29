<?php

namespace Database\Seeders;

use App\Models\Report\ReportCityRatio;
use App\Models\Report\ReportDistrictRatio;
use App\Models\Report\ReportRatio;
use App\Repositories\Enums\Reports\IPTRReportRatiosEnum;
use App\Repositories\Enums\Reports\IRatioScopeEnum;
use App\Repositories\Enums\Reports\IReportTypeEnum;
use App\Repositories\Enums\Reports\Prt\IPrtReport;
use Illuminate\Database\Seeder;

class PrtRatiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    final public function run(): void
    {
        ReportCityRatio
            ::whereIn('ratio_id', IPTRReportRatiosEnum::OldRatios)
            ->delete()
        ;
        ReportDistrictRatio
            ::whereIn('ratio_id', IPTRReportRatiosEnum::OldRatios)
            ->delete()
        ;
        ReportRatio
            ::whereIn('id', IPTRReportRatiosEnum::OldRatios)
            ->delete()
        ;

        $ratios = [
            [
                'id'             => IPrtReport::PhysicalVolumeIndexProcessingIndustrialPlan,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::PhysicalVolumeIndexProcessingIndustrialPlan ]
                ),
            ],
            [
                'id'             => IPrtReport::NonResourceExportGrowthPlan,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::NonResourceExportGrowthPlan ]
                ),
            ],
            [
                'id'             => IPrtReport::NonResourceExportGrowthFact,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::NonResourceExportGrowthFact ]
                ),
            ],
            [
                'id'             => IPrtReport::MainCapitalInvestmentsPlan,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::MainCapitalInvestmentsPlan ]
                ),
            ],
            [
                'id'             => IPrtReport::MainCapitalInvestmentsFact,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::MainCapitalInvestmentsFact ]
                ),
            ],
            [
                'id'             => IPrtReport::IfoProcessingIndustrialDynamic,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IfoProcessingIndustrialDynamic ]
                ),
            ],
            [
                'id'             => IPrtReport::NonResourceExportDynamic,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::NonResourceExportDynamic ]
                ),
            ],
            [
                'id'             => IPrtReport::MainCapitalInvestmentsInvestmentsDynamic,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::MainCapitalInvestmentsInvestmentsDynamic ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoIndustryIndustrial,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoIndustryIndustrial ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoIndustryForestAndFishing,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoIndustryForestAndFishing ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoIndustryBuild,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoIndustryBuild ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoIndustryTradeAndRepair,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoIndustryTradeAndRepair ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoIndustryLogistic,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoIndustryLogistic ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoIndustryAccommodationAndFood,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoIndustryAccommodationAndFood ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoIndustryInformAndCommunication,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoIndustryInformAndCommunication ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoIndustryFinanceAndInsurance,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoIndustryFinanceAndInsurance ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoIndustryRealEstate,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoIndustryRealEstate ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoIndustryScience,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoIndustryScience ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoIndustryAdministrateAndSupport,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoIndustryAdministrateAndSupport ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoIndustryGovernmentAndDefence,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoIndustryGovernmentAndDefence ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoIndustryEducation,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoIndustryEducation ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoIndustryHealthCare,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoIndustryHealthCare ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoIndustryArtsAndEntertainment,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoIndustryArtsAndEntertainment ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoIndustryOther,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoIndustryOther ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoIndustryHouseHold,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoIndustryHouseHold ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoIndustryExtraterritorial,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoIndustryExtraterritorial ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoIndustryMining,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoIndustryMining ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoIndustryManufacture,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoIndustryManufacture ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoIndustrySupply,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoIndustrySupply ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoIndustryWaste,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoIndustryWaste ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoExportIndustrial,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoExportIndustrial ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoExportForestAndFishing,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoExportForestAndFishing ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoExportBuild,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoExportBuild ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoExportTradeAndRepair,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoExportTradeAndRepair ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoExportLogistic,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoExportLogistic ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoExportAccommodationAndFood,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoExportAccommodationAndFood ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoExportInformAndCommunication,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoExportInformAndCommunication ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoExportFinanceAndInsurance,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoExportFinanceAndInsurance ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoExportRealEstate,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoExportRealEstate ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoExportScience,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoExportScience ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoExportAdministrateAndSupport,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoExportAdministrateAndSupport ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoExportGovernmentAndDefence,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoExportGovernmentAndDefence ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoExportEducation,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoExportEducation ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoExportHealthCare,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoExportHealthCare ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoExportArtsAndEntertainment,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoExportArtsAndEntertainment ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoExportOther,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoExportOther ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoExportHouseHold,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoExportHouseHold ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoExportExtraterritorial,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoExportExtraterritorial ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoExportMining,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoExportMining ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoExportManufacture,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoExportManufacture ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoExportSupply,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoExportSupply ]
                ),
            ],
            [
                'id'             => IPrtReport::IndustryIfoExportWaste,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::IndustryIfoExportWaste ]
                ),
            ],
            [
                'id'             => IPrtReport::Top5IndustryInvestIndustrial,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::Top5IndustryInvestIndustrial ]
                ),
            ],
            [
                'id'             => IPrtReport::Top5IndustryInvestForestAndFishing,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::Top5IndustryInvestForestAndFishing ]
                ),
            ],
            [
                'id'             => IPrtReport::Top5IndustryInvestBuild,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::Top5IndustryInvestBuild ]
                ),
            ],
            [
                'id'             => IPrtReport::Top5IndustryInvestTradeAndRepair,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::Top5IndustryInvestTradeAndRepair ]
                ),
            ],
            [
                'id'             => IPrtReport::Top5IndustryInvestLogistic,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::Top5IndustryInvestLogistic ]
                ),
            ],
            [
                'id'             => IPrtReport::Top5IndustryInvestAccommodationAndFood,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::Top5IndustryInvestAccommodationAndFood ]
                ),
            ],
            [
                'id'             => IPrtReport::Top5IndustryInvestInformAndCommunication,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::Top5IndustryInvestInformAndCommunication ]
                ),
            ],
            [
                'id'             => IPrtReport::Top5IndustryInvestFinanceAndInsurance,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::Top5IndustryInvestFinanceAndInsurance ]
                ),
            ],
            [
                'id'             => IPrtReport::Top5IndustryInvestRealEstate,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::Top5IndustryInvestRealEstate ]
                ),
            ],
            [
                'id'             => IPrtReport::Top5IndustryInvestScience,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::Top5IndustryInvestScience ]
                ),
            ],
            [
                'id'             => IPrtReport::Top5IndustryInvestAdministrateAndSupport,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::Top5IndustryInvestAdministrateAndSupport ]
                ),
            ],
            [
                'id'             => IPrtReport::Top5IndustryInvestGovernmentAndDefence,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::Top5IndustryInvestGovernmentAndDefence ]
                ),
            ],
            [
                'id'             => IPrtReport::Top5IndustryInvestEducation,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::Top5IndustryInvestEducation ]
                ),
            ],
            [
                'id'             => IPrtReport::Top5IndustryInvestHealthCare,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::Top5IndustryInvestHealthCare ]
                ),
            ],
            [
                'id'             => IPrtReport::Top5IndustryInvestArtsAndEntertainment,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::Top5IndustryInvestArtsAndEntertainment ]
                ),
            ],
            [
                'id'             => IPrtReport::Top5IndustryInvestOther,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::Top5IndustryInvestOther ]
                ),
            ],
            [
                'id'             => IPrtReport::Top5IndustryInvestHouseHold,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::Top5IndustryInvestHouseHold ]
                ),
            ],
            [
                'id'             => IPrtReport::Top5IndustryInvestExtraterritorial,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::Top5IndustryInvestExtraterritorial ]
                ),
            ],
            [
                'id'             => IPrtReport::Top5IndustryInvestMining,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::Top5IndustryInvestMining ]
                ),
            ],
            [
                'id'             => IPrtReport::Top5IndustryInvestManufacture,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::Top5IndustryInvestManufacture ]
                ),
            ],
            [
                'id'             => IPrtReport::Top5IndustryInvestSupply,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::Top5IndustryInvestSupply ]
                ),
            ],
            [
                'id'             => IPrtReport::Top5IndustryInvestWaste,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::Top5IndustryInvestWaste ]
                ),
            ],
            [
                'id'             => IPrtReport::Top5IndustryIfoUp,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypePTR,
                'name'           => trans(
                    IPrtReport::RatioNames[ IPrtReport::Top5IndustryIfoUp ]
                ),
            ],
        ];

        ReportRatio::insert($ratios);
    }
}

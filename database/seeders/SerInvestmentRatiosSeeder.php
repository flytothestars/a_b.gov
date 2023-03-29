<?php

namespace Database\Seeders;

use App\Models\Report\ReportCityRatio;
use App\Models\Report\ReportDistrictRatio;
use App\Models\Report\ReportRatio;
use App\Repositories\Enums\Reports\IInvestmentsReportRatiosEnum;
use App\Repositories\Enums\Reports\IRatioScopeEnum;
use App\Repositories\Enums\Reports\IReportTypeEnum;
use App\Repositories\Enums\Reports\Ser\IInvestmentReport;
use Illuminate\Database\Seeder;

class SerInvestmentRatiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    final public function run(): void
    {
        ReportCityRatio
            ::whereIn('ratio_id', IInvestmentsReportRatiosEnum::OldRatios)
            ->delete()
        ;
        ReportDistrictRatio
            ::whereIn('ratio_id', IInvestmentsReportRatiosEnum::OldRatios)
            ->delete()
        ;
        ReportRatio
            ::whereIn('id', IInvestmentsReportRatiosEnum::OldRatios)
            ->delete()
        ;

        $ratios = [
            [
                'id'             => IInvestmentReport::InvestmentSize,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeInvestments,
                'name'           => trans(
                    IInvestmentReport::RatioNames[ IInvestmentReport::InvestmentSize ]
                ),
            ],
            [
                'id'             => IInvestmentReport::PhysicalVolumeIndex,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeInvestments,
                'name'           => trans(
                    IInvestmentReport::RatioNames[ IInvestmentReport::PhysicalVolumeIndex ]
                ),
            ],
            [
                'id'             => IInvestmentReport::InternalInvestment,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeInvestments,
                'name'           => trans(
                    IInvestmentReport::RatioNames[ IInvestmentReport::InternalInvestment ]
                ),
            ],
            [
                'id'             => IInvestmentReport::ExternalInvestment,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeInvestments,
                'name'           => trans(
                    IInvestmentReport::RatioNames[ IInvestmentReport::ExternalInvestment ]
                ),
            ],
            [
                'id'             => IInvestmentReport::InvestmentVolumeByActivityIndustry,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeInvestments,
                'name'           => trans(
                    IInvestmentReport::RatioNames[ IInvestmentReport::InvestmentVolumeByActivityIndustry ]
                ),
            ],
            [
                'id'             => IInvestmentReport::InvestmentVolumeByActivityForestAndFishing,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeInvestments,
                'name'           => trans(
                    IInvestmentReport::RatioNames[ IInvestmentReport::InvestmentVolumeByActivityForestAndFishing ]
                ),
            ],
            [
                'id'             => IInvestmentReport::InvestmentVolumeByActivityBuild,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeInvestments,
                'name'           => trans(
                    IInvestmentReport::RatioNames[ IInvestmentReport::InvestmentVolumeByActivityBuild ]
                ),
            ],
            [
                'id'             => IInvestmentReport::InvestmentVolumeByActivityTradeAndRepair,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeInvestments,
                'name'           => trans(
                    IInvestmentReport::RatioNames[ IInvestmentReport::InvestmentVolumeByActivityTradeAndRepair ]
                ),
            ],
            [
                'id'             => IInvestmentReport::InvestmentVolumeByActivityLogistic,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeInvestments,
                'name'           => trans(
                    IInvestmentReport::RatioNames[ IInvestmentReport::InvestmentVolumeByActivityLogistic ]
                ),
            ],
            [
                'id'             => IInvestmentReport::InvestmentVolumeByActivityAccommodationAndFood,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeInvestments,
                'name'           => trans(
                    IInvestmentReport::RatioNames[ IInvestmentReport::InvestmentVolumeByActivityAccommodationAndFood ]
                ),
            ],
            [
                'id'             => IInvestmentReport::InvestmentVolumeByActivityInformAndCommunication,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeInvestments,
                'name'           => trans(
                    IInvestmentReport::RatioNames[ IInvestmentReport::InvestmentVolumeByActivityInformAndCommunication ]
                ),
            ],
            [
                'id'             => IInvestmentReport::InvestmentVolumeByActivityFinanceAndInsurance,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeInvestments,
                'name'           => trans(
                    IInvestmentReport::RatioNames[ IInvestmentReport::InvestmentVolumeByActivityFinanceAndInsurance ]
                ),
            ],
            [
                'id'             => IInvestmentReport::InvestmentVolumeByActivityRealEstate,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeInvestments,
                'name'           => trans(
                    IInvestmentReport::RatioNames[ IInvestmentReport::InvestmentVolumeByActivityRealEstate ]
                ),
            ],
            [
                'id'             => IInvestmentReport::InvestmentVolumeByActivityScience,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeInvestments,
                'name'           => trans(
                    IInvestmentReport::RatioNames[ IInvestmentReport::InvestmentVolumeByActivityScience ]
                ),
            ],
            [
                'id'             => IInvestmentReport::InvestmentVolumeByActivityAdministrateAndSupport,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeInvestments,
                'name'           => trans(
                    IInvestmentReport::RatioNames[ IInvestmentReport::InvestmentVolumeByActivityAdministrateAndSupport ]
                ),
            ],
            [
                'id'             => IInvestmentReport::InvestmentVolumeByActivityGovernmentAndDefence,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeInvestments,
                'name'           => trans(
                    IInvestmentReport::RatioNames[ IInvestmentReport::InvestmentVolumeByActivityGovernmentAndDefence ]
                ),
            ],
            [
                'id'             => IInvestmentReport::InvestmentVolumeByActivityEducation,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeInvestments,
                'name'           => trans(
                    IInvestmentReport::RatioNames[ IInvestmentReport::InvestmentVolumeByActivityEducation ]
                ),
            ],
            [
                'id'             => IInvestmentReport::InvestmentVolumeByActivityHealthCare,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeInvestments,
                'name'           => trans(
                    IInvestmentReport::RatioNames[ IInvestmentReport::InvestmentVolumeByActivityHealthCare ]
                ),
            ],
            [
                'id'             => IInvestmentReport::InvestmentVolumeByActivityArtsAndEntertainment,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeInvestments,
                'name'           => trans(
                    IInvestmentReport::RatioNames[ IInvestmentReport::InvestmentVolumeByActivityArtsAndEntertainment ]
                ),
            ],
            [
                'id'             => IInvestmentReport::InvestmentVolumeByActivityOther,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeInvestments,
                'name'           => trans(
                    IInvestmentReport::RatioNames[ IInvestmentReport::InvestmentVolumeByActivityOther ]
                ),
            ],
            [
                'id'             => IInvestmentReport::InvestmentByDistrict,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_REGION,
                'report_type_id' => IReportTypeEnum::ReportTypeInvestments,
                'name'           => trans(
                    IInvestmentReport::RatioNames[ IInvestmentReport::InvestmentByDistrict ]
                ),
            ],
            [
                'id'             => IInvestmentReport::InvestmentBySizeOfEnterprisesSmall,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeInvestments,
                'name'           => trans(
                    IInvestmentReport::RatioNames[ IInvestmentReport::InvestmentBySizeOfEnterprisesSmall ]
                ),
            ],
            [
                'id'             => IInvestmentReport::InvestmentBySizeOfEnterprisesMedium,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeInvestments,
                'name'           => trans(
                    IInvestmentReport::RatioNames[ IInvestmentReport::InvestmentBySizeOfEnterprisesMedium ]
                ),
            ],
            [
                'id'             => IInvestmentReport::InvestmentBySizeOfEnterprisesLarge,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeInvestments,
                'name'           => trans(
                    IInvestmentReport::RatioNames[ IInvestmentReport::InvestmentBySizeOfEnterprisesLarge ]
                ),
            ],
            [
                'id'             => IInvestmentReport::InvestmentByCostTypeBuilding,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeInvestments,
                'name'           => trans(
                    IInvestmentReport::RatioNames[ IInvestmentReport::InvestmentByCostTypeBuilding ]
                ),
            ],
            [
                'id'             => IInvestmentReport::InvestmentByCostTypeFarm,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeInvestments,
                'name'           => trans(
                    IInvestmentReport::RatioNames[ IInvestmentReport::InvestmentByCostTypeFarm ]
                ),
            ],
            [
                'id'             => IInvestmentReport::InvestmentByCostTypeStockRaising,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeInvestments,
                'name'           => trans(
                    IInvestmentReport::RatioNames[ IInvestmentReport::InvestmentByCostTypeStockRaising ]
                ),
            ],
            [
                'id'             => IInvestmentReport::InvestmentByCostTypeOtherCapital,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeInvestments,
                'name'           => trans(
                    IInvestmentReport::RatioNames[ IInvestmentReport::InvestmentByCostTypeOtherCapital ]
                ),
            ],
            [
                'id'             => IInvestmentReport::InvestmentByCostTypeMachinery,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeInvestments,
                'name'           => trans(
                    IInvestmentReport::RatioNames[ IInvestmentReport::InvestmentByCostTypeMachinery ]
                ),
            ],
            [
                'id'             => IInvestmentReport::InvestmentByCostTypeIt,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeInvestments,
                'name'           => trans(
                    IInvestmentReport::RatioNames[ IInvestmentReport::InvestmentByCostTypeIt ]
                ),
            ],
            [
                'id'             => IInvestmentReport::InvestmentByCostTypeExploration,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeInvestments,
                'name'           => trans(
                    IInvestmentReport::RatioNames[ IInvestmentReport::InvestmentByCostTypeExploration ]
                ),
            ],
            [
                'id'             => IInvestmentReport::InvestmentByCostTypeOther,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeInvestments,
                'name'           => trans(
                    IInvestmentReport::RatioNames[ IInvestmentReport::InvestmentByCostTypeOther ]
                ),
            ],
            [
                'id'             => IInvestmentReport::InvestmentIfoDynamic,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeInvestments,
                'name'           => trans(
                    IInvestmentReport::RatioNames[ IInvestmentReport::InvestmentIfoDynamic ]
                ),
            ],
            [
                'id'             => IInvestmentReport::InvestmentGovernmentRepublic,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeInvestments,
                'name'           => trans(
                    IInvestmentReport::RatioNames[ IInvestmentReport::InvestmentGovernmentRepublic ]
                ),
            ],
            [
                'id'             => IInvestmentReport::InvestmentGovernmentLocal,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeInvestments,
                'name'           => trans(
                    IInvestmentReport::RatioNames[ IInvestmentReport::InvestmentGovernmentLocal ]
                ),
            ],
            [
                'id'             => IInvestmentReport::InvestmentOwn,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeInvestments,
                'name'           => trans(
                    IInvestmentReport::RatioNames[ IInvestmentReport::InvestmentOwn ]
                ),
            ],
            [
                'id'             => IInvestmentReport::InvestmentLoan,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeInvestments,
                'name'           => trans(
                    IInvestmentReport::RatioNames[ IInvestmentReport::InvestmentLoan ]
                ),
            ],
        ];

        ReportRatio::insert($ratios);
    }
}

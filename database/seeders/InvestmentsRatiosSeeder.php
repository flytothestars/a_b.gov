<?php

namespace Database\Seeders;

use App\Models\Report\ReportRatio;
use App\Repositories\Enums\Reports\IInvestmentsReportRatiosEnum;
use App\Repositories\Enums\Reports\IRatioScopeEnum;
use Illuminate\Database\Seeder;

class InvestmentsRatiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ratios = [
            ['scope' => IRatioScopeEnum::RATIO_SCOPE_REGION, 'id' => IInvestmentsReportRatiosEnum::InvestmentsByDistricts, 'report_type_id' => 4, 'name' => trans(IInvestmentsReportRatiosEnum::InvestmentsByDistrictsName)],
            ['scope' => IRatioScopeEnum::RATIO_SCOPE_CITY,'id' => IInvestmentsReportRatiosEnum::InvestmentsSize, 'report_type_id' => 4, 'name' => trans(IInvestmentsReportRatiosEnum::InvestmentsSizeName)],
            ['scope' => IRatioScopeEnum::RATIO_SCOPE_CITY,'id' => IInvestmentsReportRatiosEnum::PhysicalVolumeIndex, 'report_type_id' => 4, 'name' => trans(IInvestmentsReportRatiosEnum::PhysicalVolumeIndexName)],
            ['scope' => IRatioScopeEnum::RATIO_SCOPE_CITY,'id' => IInvestmentsReportRatiosEnum::InvestmentsBySizeOfEnterprisesKB, 'report_type_id' => 4, 'name' => trans(IInvestmentsReportRatiosEnum::InvestmentsBySizeOfEnterprisesKBName)],
            ['scope' => IRatioScopeEnum::RATIO_SCOPE_CITY,'id' => IInvestmentsReportRatiosEnum::InvestmentsBySizeOfEnterprisesSB, 'report_type_id' => 4, 'name' => trans(IInvestmentsReportRatiosEnum::InvestmentsBySizeOfEnterprisesSBName)],
            ['scope' => IRatioScopeEnum::RATIO_SCOPE_CITY,'id' => IInvestmentsReportRatiosEnum::InvestmentsBySizeOfEnterprisesMB, 'report_type_id' => 4, 'name' => trans(IInvestmentsReportRatiosEnum::InvestmentsBySizeOfEnterprisesMBName)],
            ['scope' => IRatioScopeEnum::RATIO_SCOPE_CITY,'id' => IInvestmentsReportRatiosEnum::GreenInvestments, 'report_type_id' => 4, 'name' => trans(IInvestmentsReportRatiosEnum::GreenInvestmentsName)],
            ['scope' => IRatioScopeEnum::RATIO_SCOPE_CITY,'id' => IInvestmentsReportRatiosEnum::InvestmentsByCostTypeBuild, 'report_type_id' => 4, 'name' => trans(IInvestmentsReportRatiosEnum::InvestmentsByCostTypeBuildName)],
            ['scope' => IRatioScopeEnum::RATIO_SCOPE_CITY,'id' => IInvestmentsReportRatiosEnum::InvestmentsByCostTypeSB, 'report_type_id' => 4, 'name' => trans(IInvestmentsReportRatiosEnum::InvestmentsByCostTypeSBName)],
            ['scope' => IRatioScopeEnum::RATIO_SCOPE_CITY,'id' => IInvestmentsReportRatiosEnum::InvestmentsByCostTypeMB, 'report_type_id' => 4, 'name' => trans(IInvestmentsReportRatiosEnum::InvestmentsByCostTypeMBName)],
            ['scope' => IRatioScopeEnum::RATIO_SCOPE_CITY,'id' => IInvestmentsReportRatiosEnum::PrivateInvestmentToPublicFrom, 'report_type_id' => 4, 'name' => trans(IInvestmentsReportRatiosEnum::PrivateInvestmentToPublicFromName)],
            ['scope' => IRatioScopeEnum::RATIO_SCOPE_CITY,'id' => IInvestmentsReportRatiosEnum::PrivateInvestmentToPublicTo, 'report_type_id' => 4, 'name' => trans(IInvestmentsReportRatiosEnum::PrivateInvestmentToPublicToName)],
            ['scope' => IRatioScopeEnum::RATIO_SCOPE_CITY,'id' => IInvestmentsReportRatiosEnum::GrowthGrpFromInvestmentGrowth, 'report_type_id' => 4, 'name' => trans(IInvestmentsReportRatiosEnum::GrowthGrpFromInvestmentGrowthName)],
            ['scope' => IRatioScopeEnum::RATIO_SCOPE_CITY,'id' => IInvestmentsReportRatiosEnum::InvestmentsIntangibleFixedAssets, 'report_type_id' => 4, 'name' => trans(IInvestmentsReportRatiosEnum::InvestmentsIntangibleFixedAssetsName)],
            ['scope' => IRatioScopeEnum::RATIO_SCOPE_CITY,'id' => IInvestmentsReportRatiosEnum::BorrowedFunds, 'report_type_id' => 4, 'name' => trans(IInvestmentsReportRatiosEnum::BorrowedFundsName)],
            ['scope' => IRatioScopeEnum::RATIO_SCOPE_CITY,'id' => IInvestmentsReportRatiosEnum::ExternalInvestment, 'report_type_id' => 4, 'name' => trans(IInvestmentsReportRatiosEnum::ExternalInvestmentName)],
            ['scope' => IRatioScopeEnum::RATIO_SCOPE_CITY,'id' => IInvestmentsReportRatiosEnum::PublicInvestment, 'report_type_id' => 4, 'name' => trans(IInvestmentsReportRatiosEnum::PublicInvestmentName)],
            ['scope' => IRatioScopeEnum::RATIO_SCOPE_CITY,'id' => IInvestmentsReportRatiosEnum::OwnInvestment, 'report_type_id' => 4, 'name' => trans(IInvestmentsReportRatiosEnum::OwnInvestmentName)],
            ['scope' => IRatioScopeEnum::RATIO_SCOPE_CITY,'id' => IInvestmentsReportRatiosEnum::InvestmentToCreateOneJobTrade, 'report_type_id' => 4, 'name' => trans(IInvestmentsReportRatiosEnum::InvestmentToCreateOneJobTradeName)],
            ['scope' => IRatioScopeEnum::RATIO_SCOPE_CITY,'id' => IInvestmentsReportRatiosEnum::InvestmentToCreateOneJobOther, 'report_type_id' => 4, 'name' => trans(IInvestmentsReportRatiosEnum::InvestmentToCreateOneJobOtherName)],
            ['scope' => IRatioScopeEnum::RATIO_SCOPE_CITY,'id' => IInvestmentsReportRatiosEnum::InvestmentToCreateOneJobEducation, 'report_type_id' => 4, 'name' => trans(IInvestmentsReportRatiosEnum::InvestmentToCreateOneJobEducationName)],
            ['scope' => IRatioScopeEnum::RATIO_SCOPE_CITY,'id' => IInvestmentsReportRatiosEnum::InvestmentToCreateOneJobTransport, 'report_type_id' => 4, 'name' => trans(IInvestmentsReportRatiosEnum::InvestmentToCreateOneJobTransportName)],
            ['scope' => IRatioScopeEnum::RATIO_SCOPE_CITY,'id' => IInvestmentsReportRatiosEnum::InvestmentToCreateOneJobHealthCare, 'report_type_id' => 4, 'name' => trans(IInvestmentsReportRatiosEnum::InvestmentToCreateOneJobHealthCareName)],
            ['scope' => IRatioScopeEnum::RATIO_SCOPE_CITY,'id' => IInvestmentsReportRatiosEnum::InvestmentsNonResourceSector, 'report_type_id' => 4, 'name' => trans(IInvestmentsReportRatiosEnum::InvestmentsNonResourceSectorName)],
            ['scope' => IRatioScopeEnum::RATIO_SCOPE_CITY,'id' => IInvestmentsReportRatiosEnum::ExternalInvestmentsNonResourceSector, 'report_type_id' => 4, 'name' => trans(IInvestmentsReportRatiosEnum::ExternalInvestmentsNonResourceSectorName)],
            ['scope' => IRatioScopeEnum::RATIO_SCOPE_CITY,'id' => IInvestmentsReportRatiosEnum::InvestitionByBusinessTypesTrade, 'report_type_id' => 4, 'name' => trans(IInvestmentsReportRatiosEnum::InvestitionByBusinessTypesTradeName)],
            ['scope' => IRatioScopeEnum::RATIO_SCOPE_CITY,'id' => IInvestmentsReportRatiosEnum::InvestitionByBusinessTypesOther, 'report_type_id' => 4, 'name' => trans(IInvestmentsReportRatiosEnum::InvestitionByBusinessTypesOtherName)],
            ['scope' => IRatioScopeEnum::RATIO_SCOPE_CITY,'id' => IInvestmentsReportRatiosEnum::InvestitionByBusinessTypesEducation, 'report_type_id' => 4, 'name' => trans(IInvestmentsReportRatiosEnum::InvestitionByBusinessTypesEducationName)],
            ['scope' => IRatioScopeEnum::RATIO_SCOPE_CITY,'id' => IInvestmentsReportRatiosEnum::InvestitionByBusinessTypesTransport, 'report_type_id' => 4, 'name' => trans(IInvestmentsReportRatiosEnum::InvestitionByBusinessTypesTransportName)],
            ['scope' => IRatioScopeEnum::RATIO_SCOPE_CITY,'id' => IInvestmentsReportRatiosEnum::InvestitionByBusinessTypesHealthCare, 'report_type_id' => 4, 'name' => trans(IInvestmentsReportRatiosEnum::InvestitionByBusinessTypesHealthCareName)],
        ];

        ReportRatio::insert($ratios);

    }
}

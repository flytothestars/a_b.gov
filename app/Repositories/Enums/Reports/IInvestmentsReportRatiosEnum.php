<?php

namespace App\Repositories\Enums\Reports;

interface IInvestmentsReportRatiosEnum
{
    public const InvestmentsByDistricts               = '50104e8c-a290-4d74-8d3d-7d5b1d075931';
    public const InvestmentsSize                      = '1983ccbe-1c74-4ef4-ac44-f34a3a5b21e9';
    public const PhysicalVolumeIndex                  = '614f3495-db3b-4eef-83be-9e9080f8e7b0';
    public const InvestmentsBySizeOfEnterprises       = '31385a8a-1baa-4757-8935-66c7455d0c8a';
    public const InvestmentsBySizeOfEnterprisesKB     = 'fae1603e-bea9-4973-97b1-63981fc647fd';
    public const InvestmentsBySizeOfEnterprisesSB     = 'd1b2f066-ec40-4b4a-8203-794a0935eb1b';
    public const InvestmentsBySizeOfEnterprisesMB     = '59a2a85e-ad07-478a-b367-abe9e202fa8c';
    public const GreenInvestments                     = '00b97d93-2241-4a0f-8e9d-9478cbc10c40';
    public const InvestmentsByCostType                = 'd21c7273-32fd-4dbc-965f-5be4ce23c420';
    public const InvestmentsByCostTypeBuild           = '7d45528e-380f-42b3-8037-b0da57d4788c';
    public const InvestmentsByCostTypeSB              = '3264e140-cb5c-4486-b572-b0ceedf16c50';
    public const InvestmentsByCostTypeMB              = '57da3947-2afd-4dc9-b4ab-1d089c310aa0';
    public const PrivateInvestmentToPublicFrom        = '67c7ae23-daa6-49a4-93f2-40600f5dd325';
    public const PrivateInvestmentToPublicTo          = '326f4094-0969-4c59-a129-c1fc66082510';
    public const GrowthGrpFromInvestmentGrowth        = '689f20fb-0de6-4058-baf0-22effd16c664';
    public const InvestmentsIntangibleFixedAssets     = 'edefb890-5a6b-4ec3-b543-11c7a1455832';
    public const BorrowedFunds                        = '010a648c-e4e3-459e-8524-47a4f1046748';
    public const ExternalInvestment                   = 'b4e71439-1471-4b3f-890b-ecc50e708272';
    public const PublicInvestment                     = '6b73209d-a8e4-4006-8e78-5b250b6a67d1';
    public const OwnInvestment                        = 'a6a1d348-ad8e-450c-96d8-681846ccef87';
    public const InvestmentToCreateOneJob             = 'b6cbd1c1-69a5-4256-bc3e-e842753f97d9';
    public const InvestmentToCreateOneJobTrade        = 'a388f4a2-1cee-44da-822b-66d95e5c8002';
    public const InvestmentToCreateOneJobOther        = '27768d55-4a17-404b-b35c-760c625381e2';
    public const InvestmentToCreateOneJobEducation    = '22d0f408-016d-4899-8d8c-407138166264';
    public const InvestmentToCreateOneJobTransport    = 'c96751d8-856c-4f3e-8c40-c66d05cd8a9e';
    public const InvestmentToCreateOneJobHealthCare   = 'dd26da5c-2828-41e9-99bc-130d5a512fc6';
    public const InvestmentsNonResourceSector         = '475b9665-1bf3-4f08-b0c4-cf7a364e9edf';
    public const ExternalInvestmentsNonResourceSector = 'a186a6ae-32bd-4d9d-a25c-9642d298f0e1';
    public const InvestitionByBusinessTypes           = 'a6a88bdf-d486-480d-8728-9bf779086376';
    public const InvestitionByBusinessTypesTrade      = '1745ec30-7916-4e69-b6c6-e637e63798bb';
    public const InvestitionByBusinessTypesOther      = '3f0d33e7-dade-467e-b45b-d2c855d1f143';
    public const InvestitionByBusinessTypesEducation  = '829f5b2b-7144-4620-b940-2d10725afe44';
    public const InvestitionByBusinessTypesTransport  = '794635d7-d0a7-4664-b3e6-77e7d5f70ea9';
    public const InvestitionByBusinessTypesHealthCare = '2b4a6ce4-5c45-489b-afe7-d8d3b9e47c0a';

    public const InvestmentsByDistrictsName               = 'report.Investments.InvestmentsByDistrictsName';
    public const InvestmentsSizeName                      = 'report.Investments.InvestmentsSizeName';
    public const PhysicalVolumeIndexName                  = 'report.Investments.PhysicalVolumeIndexName';
    public const InvestmentsBySizeOfEnterprisesName       = 'report.Investments.InvestmentsBySizeOfEnterprises';
    public const InvestmentsBySizeOfEnterprisesKBName     = 'report.Investments.InvestmentsBySizeOfEnterprisesKBName';
    public const InvestmentsBySizeOfEnterprisesSBName     = 'report.Investments.InvestmentsBySizeOfEnterprisesSBName';
    public const InvestmentsBySizeOfEnterprisesMBName     = 'report.Investments.InvestmentsBySizeOfEnterprisesMBName';
    public const GreenInvestmentsName                     = 'report.Investments.GreenInvestmentsName';
    public const InvestmentsByCostTypeName                = 'report.Investments.InvestmentsByCostTypeName';
    public const InvestmentsByCostTypeBuildName           = 'report.Investments.InvestmentsByCostTypeBuildName';
    public const InvestmentsByCostTypeSBName              = 'report.Investments.InvestmentsByCostTypeSBName';
    public const InvestmentsByCostTypeMBName              = 'report.Investments.InvestmentsByCostTypeMBName';
    public const PrivateInvestmentToPublicFromName        = 'report.Investments.PrivateInvestmentToPublicFromName';
    public const PrivateInvestmentToPublicToName          = 'report.Investments.PrivateInvestmentToPublicToName';
    public const GrowthGrpFromInvestmentGrowthName        = 'report.Investments.GrowthGrpFromInvestmentGrowthName';
    public const InvestmentsIntangibleFixedAssetsName     = 'report.Investments.InvestmentsIntangibleFixedAssetsName';
    public const BorrowedFundsName                        = 'report.Investments.BorrowedFundsName';
    public const ExternalInvestmentName                   = 'report.Investments.ExternalInvestmentName';
    public const PublicInvestmentName                     = 'report.Investments.PublicInvestmentName';
    public const OwnInvestmentName                        = 'report.Investments.OwnInvestmentName';
    public const InvestmentToCreateOneJobName             = 'report.Investments.InvestmentToCreateOneJobName';
    public const InvestmentToCreateOneJobTradeName        = 'report.Investments.InvestmentToCreateOneJobTradeName';
    public const InvestmentToCreateOneJobOtherName        = 'report.Investments.InvestmentToCreateOneJobOtherName';
    public const InvestmentToCreateOneJobEducationName    = 'report.Investments.InvestmentToCreateOneJobEducationName';
    public const InvestmentToCreateOneJobTransportName    = 'report.Investments.InvestmentToCreateOneJobTransportName';
    public const InvestmentToCreateOneJobHealthCareName   = 'report.Investments.InvestmentToCreateOneJobHealthCareName';
    public const InvestmentsNonResourceSectorName         = 'report.Investments.InvestmentsNonResourceSectorName';
    public const ExternalInvestmentsNonResourceSectorName = 'report.Investments.ExternalInvestmentsNonResourceSectorName';
    public const InvestitionByBusinessTypesName           = 'report.Investments.InvestitionByBusinessTypesName';
    public const InvestitionByBusinessTypesTradeName      = 'report.Investments.InvestitionByBusinessTypesTradeName';
    public const InvestitionByBusinessTypesOtherName      = 'report.Investments.InvestitionByBusinessTypesOtherName';
    public const InvestitionByBusinessTypesEducationName  = 'report.Investments.InvestitionByBusinessTypesEducationName';
    public const InvestitionByBusinessTypesTransportName  = 'report.Investments.InvestitionByBusinessTypesTransportName';
    public const InvestitionByBusinessTypesHealthCareName = 'report.Investments.InvestitionByBusinessTypesHealthCareName';

    public const VIRTUAL_RATIOS = [
        self::InvestmentsByDistricts,
        self::InvestmentsBySizeOfEnterprises,
        self::InvestmentsByCostType,
        self::InvestmentToCreateOneJob,
        self::InvestitionByBusinessTypes,
    ];

    public const VIRTUAL_RATIOS_LIST = [
        self::InvestmentsBySizeOfEnterprises => [
            self::InvestmentsBySizeOfEnterprisesKB,
            self::InvestmentsBySizeOfEnterprisesMB,
            self::InvestmentsBySizeOfEnterprisesSB,
        ],
        self::InvestmentsByCostType          => [
            self::InvestmentsByCostTypeBuild,
            self::InvestmentsByCostTypeMB,
            self::InvestmentsByCostTypeSB,
        ],
        self::InvestmentToCreateOneJob       => [
            self::InvestmentToCreateOneJobTrade,
            self::InvestmentToCreateOneJobOther,
            self::InvestmentToCreateOneJobEducation,
            self::InvestmentToCreateOneJobTransport,
            self::InvestmentToCreateOneJobHealthCare,
        ],
        self::InvestitionByBusinessTypes     => [
            self::InvestitionByBusinessTypesTrade,
            self::InvestitionByBusinessTypesOther,
            self::InvestitionByBusinessTypesEducation,
            self::InvestitionByBusinessTypesTransport,
            self::InvestitionByBusinessTypesHealthCare,
        ],
    ];

    public const CITY_RATIOS_LIST = [
        self::InvestmentsSize,
        self::PhysicalVolumeIndex,
        self::InvestmentsBySizeOfEnterprisesKB,
        self::InvestmentsBySizeOfEnterprisesSB,
        self::InvestmentsBySizeOfEnterprisesMB,
        self::GreenInvestments,
        self::InvestmentsByCostTypeBuild,
        self::InvestmentsByCostTypeSB,
        self::InvestmentsByCostTypeMB,
        self::PrivateInvestmentToPublicFrom,
        self::PrivateInvestmentToPublicTo,
        self::GrowthGrpFromInvestmentGrowth,
        self::InvestmentsIntangibleFixedAssets,
        self::BorrowedFunds,
        self::ExternalInvestment,
        self::PublicInvestment,
        self::OwnInvestment,
        self::InvestmentToCreateOneJobTrade,
        self::InvestmentToCreateOneJobOther,
        self::InvestmentToCreateOneJobEducation,
        self::InvestmentToCreateOneJobTransport,
        self::InvestmentToCreateOneJobHealthCare,
        self::InvestmentsNonResourceSector,
        self::ExternalInvestmentsNonResourceSector,
        self::InvestitionByBusinessTypesTrade,
        self::InvestitionByBusinessTypesOther,
        self::InvestitionByBusinessTypesEducation,
        self::InvestitionByBusinessTypesTransport,
        self::InvestitionByBusinessTypesHealthCare,
    ];

    public const CITY_RATIOS_LIST_PLAIN = [
        self::InvestmentsSize,
        self::PhysicalVolumeIndex,
        self::GreenInvestments,
        self::PrivateInvestmentToPublicFrom,
        self::PrivateInvestmentToPublicTo,
        self::GrowthGrpFromInvestmentGrowth,
        self::InvestmentsIntangibleFixedAssets,
        self::BorrowedFunds,
        self::ExternalInvestment,
        self::PublicInvestment,
        self::OwnInvestment,
        self::InvestmentsNonResourceSector,
        self::ExternalInvestmentsNonResourceSector,
    ];

    public const CITY_RATIOS_LIST_NAMES = [
        self::InvestmentsSize                      => 'InvestmentsSize',
        self::PhysicalVolumeIndex                  => 'PhysicalVolumeIndex',
        self::GreenInvestments                     => 'GreenInvestments',
        self::PrivateInvestmentToPublicFrom        => 'PrivateInvestmentToPublicFrom',
        self::PrivateInvestmentToPublicTo          => 'PrivateInvestmentToPublicTo',
        self::GrowthGrpFromInvestmentGrowth        => 'GrowthGrpFromInvestmentGrowth',
        self::InvestmentsIntangibleFixedAssets     => 'InvestmentsIntangibleFixedAssets',
        self::BorrowedFunds                        => 'BorrowedFunds',
        self::ExternalInvestment                   => 'ExternalInvestment',
        self::PublicInvestment                     => 'PublicInvestment',
        self::OwnInvestment                        => 'OwnInvestment',
        self::InvestmentsNonResourceSector         => 'InvestmentsNonResourceSector',
        self::ExternalInvestmentsNonResourceSector => 'ExternalInvestmentsNonResourceSector',
    ];

    public const OldRatios = [
        self::InvestmentsByDistricts,
        self::InvestmentsSize,
        self::PhysicalVolumeIndex,
        self::InvestmentsBySizeOfEnterprises,
        self::InvestmentsBySizeOfEnterprisesKB,
        self::InvestmentsBySizeOfEnterprisesSB,
        self::InvestmentsBySizeOfEnterprisesMB,
        self::GreenInvestments,
        self::InvestmentsByCostType,
        self::InvestmentsByCostTypeBuild,
        self::InvestmentsByCostTypeSB,
        self::InvestmentsByCostTypeMB,
        self::PrivateInvestmentToPublicFrom,
        self::PrivateInvestmentToPublicTo,
        self::GrowthGrpFromInvestmentGrowth,
        self::InvestmentsIntangibleFixedAssets,
        self::BorrowedFunds,
        self::ExternalInvestment,
        self::PublicInvestment,
        self::OwnInvestment,
        self::InvestmentToCreateOneJob,
        self::InvestmentToCreateOneJobTrade,
        self::InvestmentToCreateOneJobOther,
        self::InvestmentToCreateOneJobEducation,
        self::InvestmentToCreateOneJobTransport,
        self::InvestmentToCreateOneJobHealthCare,
        self::InvestmentsNonResourceSector,
        self::ExternalInvestmentsNonResourceSector,
        self::InvestitionByBusinessTypes,
        self::InvestitionByBusinessTypesTrade,
        self::InvestitionByBusinessTypesOther,
        self::InvestitionByBusinessTypesEducation,
        self::InvestitionByBusinessTypesTransport,
        self::InvestitionByBusinessTypesHealthCare,
    ];

}

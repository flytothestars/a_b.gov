<?php

namespace App\Repositories\Enums\Reports;

interface IPTRReportRatiosEnum
{
    public const PhysicalVolumeIndexManufactureByDistricts      = '8fbc749a-7c1b-4d55-aa9f-832969ff9fdd';
    public const PhysicalVolumeIndexIndustries                  = '1354f7b4-8240-4988-9e32-bdaf9e0632b4';
    public const PhysicalVolumeIndexIndustriesFood              = 'cb32ce54-f8ca-4b5c-93f3-151c76c838c0';
    public const PhysicalVolumeIndexIndustriesPharma            = 'a38db794-bf76-4acd-b273-6d0d32dc38a5';
    public const PhysicalVolumeIndexIndustriesFurniture         = '4177183f-67e3-4bdd-8d8a-25e5b5b39e9d';
    public const PhysicalVolumeIndexIndustriesLight             = '39f50904-dfac-4ad9-bb28-ee41ea796bd1';
    public const PhysicalVolumeIndexIndustriesChemical          = '38753895-1998-41ff-a8d4-858edc37c16f';
    public const PhysicalVolumeIndexManufactureVolumeAmount     = 'a5b5d0ea-ebb5-4b85-9e6d-3107d87ad54d';
    public const PhysicalVolumeIndexManufactureVolumeAmountPlan = '1a8c98bc-8f24-4cce-a3f5-1bb235c1a654';
    public const PhysicalVolumeIndexManufactureVolumeAmountFact = '726827e7-d661-4028-a81b-891f2d106ef9';
    public const PhysicalVolumeIndexManufactureAgriculture      = 'de7d03d0-c978-4d7e-885f-3421fe812372';
    public const PhysicalVolumeIndexManufactureAgriculturePlan  = '876209fa-76e5-4046-b5b0-333707004daa';
    public const PhysicalVolumeIndexManufactureAgricultureFact  = '62b7f83c-c3f2-43d0-93ba-132867966595';
    public const PhysicalVolumeIndexManufacture                 = '4da163d6-e484-40c3-b18c-40b8374bb2fd';
    public const PhysicalVolumeIndexManufacturePlan             = '270eca6f-ccf5-43e3-be33-2fc6b027fd7a';
    public const PhysicalVolumeIndexManufactureFact             = 'eb066c94-d45e-4e21-9ebe-fda65fde2212';
    public const ExportNonResourceVolumeGrowth                  = 'b8d30212-c04c-4875-97c1-1ce36ab47244';
    public const ExportNonResourceVolumeGrowthPlan              = '5212532b-4546-46d8-9fb5-7ab0baa4ee6e';
    public const ExportNonResourceVolumeGrowthFact              = '37ee9ec8-01a4-4264-9762-d101f6e5b7ad';
    public const PhysicalVolumeIndexManufactureInvestments      = '01a49efe-3e20-4ff0-b6ae-a85f1f1a7697';
    public const PhysicalVolumeIndexManufactureInvestmentsPlan  = '25ebecca-e3f4-499e-9c1a-e7fb729c8e87';
    public const PhysicalVolumeIndexManufactureInvestmentsFact  = '29c6bc29-551e-4976-ab1c-5a3935c7b103';
    public const VPR_MSB_Volume                                 = '6cae29df-e8f7-4655-9c47-da807dcd7087';
    public const VPR_MSB_VolumePlan                             = '2edf9ba3-3a22-4632-86ea-01fad1e57c7f';
    public const VPR_MSB_VolumeFact                             = 'd6b38067-a0bd-4bd9-ae30-2ca4c5b0eabb';

    public const IndicatorComparison                            = 'IndicatorComparison';


    public const VIRTUAL_RATIOS = [
        self::PhysicalVolumeIndexManufactureByDistricts,
        self::PhysicalVolumeIndexIndustries,
    ];

    public const PLAN_FACT_RATIOS_LIST = [
        self::PhysicalVolumeIndexManufactureVolumeAmount,
        self::PhysicalVolumeIndexManufactureAgriculture,
        self::PhysicalVolumeIndexManufacture,
        self::ExportNonResourceVolumeGrowth,
        self::PhysicalVolumeIndexManufactureInvestments,
        self::VPR_MSB_Volume,
    ];

    public const CITY_RATIOS_LIST = [
        self::PhysicalVolumeIndexIndustriesFood,
        self::PhysicalVolumeIndexIndustriesPharma,
        self::PhysicalVolumeIndexIndustriesFurniture,
        self::PhysicalVolumeIndexIndustriesLight,
        self::PhysicalVolumeIndexIndustriesChemical,
        self::PhysicalVolumeIndexManufactureVolumeAmountPlan,
        self::PhysicalVolumeIndexManufactureVolumeAmountFact,
        self::PhysicalVolumeIndexManufactureAgriculturePlan,
        self::PhysicalVolumeIndexManufactureAgricultureFact,
        self::PhysicalVolumeIndexManufacturePlan,
        self::PhysicalVolumeIndexManufactureFact,
        self::ExportNonResourceVolumeGrowthPlan,
        self::ExportNonResourceVolumeGrowthFact,
        self::PhysicalVolumeIndexManufactureInvestmentsPlan,
        self::PhysicalVolumeIndexManufactureInvestmentsFact,
        self::VPR_MSB_VolumePlan,
        self::VPR_MSB_VolumeFact,
    ];

    public const CITY_RATIOS_LIST_PLAIN = [

    ];

    public const CITY_RATIOS_LIST_NAMES = [
        self::PhysicalVolumeIndexManufactureByDistricts      => 'PhysicalVolumeIndexManufactureByDistricts',
        self::PhysicalVolumeIndexIndustries                  => 'PhysicalVolumeIndexIndustries',
        self::PhysicalVolumeIndexIndustriesFood              => 'PhysicalVolumeIndexIndustriesFood',
        self::PhysicalVolumeIndexIndustriesPharma            => 'PhysicalVolumeIndexIndustriesPharma',
        self::PhysicalVolumeIndexIndustriesFurniture         => 'PhysicalVolumeIndexIndustriesFurniture',
        self::PhysicalVolumeIndexIndustriesLight             => 'PhysicalVolumeIndexIndustriesLight',
        self::PhysicalVolumeIndexIndustriesChemical          => 'PhysicalVolumeIndexIndustriesChemical',
        self::PhysicalVolumeIndexManufactureVolumeAmount     => 'PhysicalVolumeIndexManufactureVolumeAmount',
        self::PhysicalVolumeIndexManufactureVolumeAmountPlan => 'Plan',
        self::PhysicalVolumeIndexManufactureVolumeAmountFact => 'Fact',
        self::PhysicalVolumeIndexManufactureAgriculture      => 'PhysicalVolumeIndexManufactureAgriculture',
        self::PhysicalVolumeIndexManufactureAgriculturePlan  => 'Plan',
        self::PhysicalVolumeIndexManufactureAgricultureFact  => 'Fact',
        self::PhysicalVolumeIndexManufacture                 => 'PhysicalVolumeIndexManufacture',
        self::PhysicalVolumeIndexManufacturePlan             => 'Plan',
        self::PhysicalVolumeIndexManufactureFact             => 'Fact',
        self::ExportNonResourceVolumeGrowth                  => 'ExportNonResourceVolumeGrowth',
        self::ExportNonResourceVolumeGrowthPlan              => 'Plan',
        self::ExportNonResourceVolumeGrowthFact              => 'Fact',
        self::PhysicalVolumeIndexManufactureInvestments      => 'PhysicalVolumeIndexManufactureInvestments',
        self::PhysicalVolumeIndexManufactureInvestmentsPlan  => 'Plan',
        self::PhysicalVolumeIndexManufactureInvestmentsFact  => 'Fact',
        self::VPR_MSB_Volume                                 => 'VPR_MSB_Volume',
        self::VPR_MSB_VolumePlan                             => 'Plan',
        self::VPR_MSB_VolumeFact                             => 'Fact',
    ];

    public const OldRatios = [
        self::PhysicalVolumeIndexManufactureByDistricts,
        self::PhysicalVolumeIndexIndustries,
        self::PhysicalVolumeIndexIndustriesFood,
        self::PhysicalVolumeIndexIndustriesPharma,
        self::PhysicalVolumeIndexIndustriesFurniture,
        self::PhysicalVolumeIndexIndustriesLight,
        self::PhysicalVolumeIndexIndustriesChemical,
        self::PhysicalVolumeIndexManufactureVolumeAmount,
        self::PhysicalVolumeIndexManufactureVolumeAmountPlan,
        self::PhysicalVolumeIndexManufactureVolumeAmountFact,
        self::PhysicalVolumeIndexManufactureAgriculture,
        self::PhysicalVolumeIndexManufactureAgriculturePlan,
        self::PhysicalVolumeIndexManufactureAgricultureFact,
        self::PhysicalVolumeIndexManufacture,
        self::PhysicalVolumeIndexManufacturePlan,
        self::PhysicalVolumeIndexManufactureFact,
        self::ExportNonResourceVolumeGrowth,
        self::ExportNonResourceVolumeGrowthPlan,
        self::ExportNonResourceVolumeGrowthFact,
        self::PhysicalVolumeIndexManufactureInvestments,
        self::PhysicalVolumeIndexManufactureInvestmentsPlan,
        self::PhysicalVolumeIndexManufactureInvestmentsFact,
        self::VPR_MSB_Volume,
        self::VPR_MSB_VolumePlan,
        self::VPR_MSB_VolumeFact,
    ];

}

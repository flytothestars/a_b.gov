<?php

namespace Database\Seeders;

use App\Models\Report\ReportCityRatio;
use App\Models\Report\ReportDistrictRatio;
use App\Models\Report\ReportRatio;
use App\Repositories\Enums\Reports\IIndustryReportRatioEnum;
use App\Repositories\Enums\Reports\IRatioScopeEnum;
use App\Repositories\Enums\Reports\IReportTypeEnum;
use App\Repositories\Enums\Reports\Ser\IIndustryRatioReport;
use Illuminate\Database\Seeder;

class SerIndustryRatiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    final public function run(): void
    {
        ReportCityRatio
            ::whereIn('ratio_id', IIndustryReportRatioEnum::OldRatios)
            ->delete()
        ;
        ReportDistrictRatio
            ::whereIn('ratio_id', IIndustryReportRatioEnum::OldRatios)
            ->delete()
        ;
        ReportRatio
            ::whereIn('id', IIndustryReportRatioEnum::OldRatios)
            ->delete()
        ;

        $ratios = [
            [
                'id'             => IIndustryRatioReport::EnterpriseNumber,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(
                    IIndustryRatioReport::RatioNames[ IIndustryRatioReport::EnterpriseNumber ]
                ),
            ],
            [
                'id'             => IIndustryRatioReport::Employed,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(
                    IIndustryRatioReport::RatioNames[ IIndustryRatioReport::Employed ]
                ),
            ],
            [
                'id'             => IIndustryRatioReport::AverageSalary,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(
                    IIndustryRatioReport::RatioNames[ IIndustryRatioReport::AverageSalary ]
                ),
            ],
            [
                'id'             => IIndustryRatioReport::IndustrialProductionVolume,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(
                    IIndustryRatioReport::RatioNames[ IIndustryRatioReport::IndustrialProductionVolume ]
                ),
            ],
            [
                'id'             => IIndustryRatioReport::IndustrialProductionVolumeIndustryMining,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(
                    IIndustryRatioReport::RatioNames[ IIndustryRatioReport::IndustrialProductionVolumeIndustryMining ]
                ),
            ],
            [
                'id'             => IIndustryRatioReport::IndustrialProductionVolumeIndustryManufacturing,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(
                    IIndustryRatioReport::RatioNames[ IIndustryRatioReport::IndustrialProductionVolumeIndustryManufacturing ]
                ),
            ],
            [
                'id'             => IIndustryRatioReport::IndustrialProductionVolumeIndustrySupply,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(
                    IIndustryRatioReport::RatioNames[ IIndustryRatioReport::IndustrialProductionVolumeIndustrySupply ]
                ),
            ],
            [
                'id'             => IIndustryRatioReport::IndustrialProductionVolumeIndustryWaterAndWaste,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(
                    IIndustryRatioReport::RatioNames[ IIndustryRatioReport::IndustrialProductionVolumeIndustryWaterAndWaste ]
                ),
            ],
            [
                'id'             => IIndustryRatioReport::ManufacturingIndustryOutput,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(
                    IIndustryRatioReport::RatioNames[ IIndustryRatioReport::ManufacturingIndustryOutput ]
                ),
            ],
            [
                'id'             => IIndustryRatioReport::ManufacturingIndustryStructureEngineering,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(
                    IIndustryRatioReport::RatioNames[ IIndustryRatioReport::ManufacturingIndustryStructureEngineering ]
                ),
            ],
            [
                'id'             => IIndustryRatioReport::ManufacturingIndustryStructureLight,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(
                    IIndustryRatioReport::RatioNames[ IIndustryRatioReport::ManufacturingIndustryStructureLight ]
                ),
            ],
            [
                'id'             => IIndustryRatioReport::ManufacturingIndustryStructureFood,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(
                    IIndustryRatioReport::RatioNames[ IIndustryRatioReport::ManufacturingIndustryStructureFood ]
                ),
            ],
            [
                'id'             => IIndustryRatioReport::ManufacturingIndustryStructureDrink,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(
                    IIndustryRatioReport::RatioNames[ IIndustryRatioReport::ManufacturingIndustryStructureDrink ]
                ),
            ],
            [
                'id'             => IIndustryRatioReport::ManufacturingIndustryStructureTobacco,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(
                    IIndustryRatioReport::RatioNames[ IIndustryRatioReport::ManufacturingIndustryStructureTobacco ]
                ),
            ],
            [
                'id'             => IIndustryRatioReport::ManufacturingIndustryStructureWoodAndCork,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(
                    IIndustryRatioReport::RatioNames[ IIndustryRatioReport::ManufacturingIndustryStructureWoodAndCork ]
                ),
            ],
            [
                'id'             => IIndustryRatioReport::ManufacturingIndustryStructurePaper,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(
                    IIndustryRatioReport::RatioNames[ IIndustryRatioReport::ManufacturingIndustryStructurePaper ]
                ),
            ],
            [
                'id'             => IIndustryRatioReport::ManufacturingIndustryStructurePrintingAndMedia,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(
                    IIndustryRatioReport::RatioNames[ IIndustryRatioReport::ManufacturingIndustryStructurePrintingAndMedia ]
                ),
            ],
            [
                'id'             => IIndustryRatioReport::ManufacturingIndustryStructurePetroleum,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(
                    IIndustryRatioReport::RatioNames[ IIndustryRatioReport::ManufacturingIndustryStructurePetroleum ]
                ),
            ],
            [
                'id'             => IIndustryRatioReport::ManufacturingIndustryStructureChemical,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(
                    IIndustryRatioReport::RatioNames[ IIndustryRatioReport::ManufacturingIndustryStructureChemical ]
                ),
            ],
            [
                'id'             => IIndustryRatioReport::ManufacturingIndustryStructurePharmaceutical,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(
                    IIndustryRatioReport::RatioNames[ IIndustryRatioReport::ManufacturingIndustryStructurePharmaceutical ]
                ),
            ],
            [
                'id'             => IIndustryRatioReport::ManufacturingIndustryStructureRubberAndPlastic,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(
                    IIndustryRatioReport::RatioNames[ IIndustryRatioReport::ManufacturingIndustryStructureRubberAndPlastic ]
                ),
            ],
            [
                'id'             => IIndustryRatioReport::ManufacturingIndustryStructureOtherNonMetal,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(
                    IIndustryRatioReport::RatioNames[ IIndustryRatioReport::ManufacturingIndustryStructureOtherNonMetal ]
                ),
            ],
            [
                'id'             => IIndustryRatioReport::ManufacturingIndustryStructureMetallurgical,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(
                    IIndustryRatioReport::RatioNames[ IIndustryRatioReport::ManufacturingIndustryStructureMetallurgical ]
                ),
            ],
            [
                'id'             => IIndustryRatioReport::ManufacturingIndustryStructureMetalProductsNonMachinery,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(
                    IIndustryRatioReport::RatioNames[ IIndustryRatioReport::ManufacturingIndustryStructureMetalProductsNonMachinery ]
                ),
            ],
            [
                'id'             => IIndustryRatioReport::ManufacturingIndustryStructureFurniture,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(
                    IIndustryRatioReport::RatioNames[ IIndustryRatioReport::ManufacturingIndustryStructureFurniture ]
                ),
            ],
            [
                'id'             => IIndustryRatioReport::ManufacturingIndustryStructureOther,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(
                    IIndustryRatioReport::RatioNames[ IIndustryRatioReport::ManufacturingIndustryStructureOther ]
                ),
            ],
            [
                'id'             => IIndustryRatioReport::PhysicalVolumeIndexIndustrialProduction,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(
                    IIndustryRatioReport::RatioNames[ IIndustryRatioReport::PhysicalVolumeIndexIndustrialProduction ]
                ),
            ],
            [
                'id'             => IIndustryRatioReport::PhysicalVolumeIndexManufacturing,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(
                    IIndustryRatioReport::RatioNames[ IIndustryRatioReport::PhysicalVolumeIndexManufacturing ]
                ),
            ],
            [
                'id'             => IIndustryRatioReport::TaxRevenues,
                'scope'          => IRatioScopeEnum::RATIO_SCOPE_CITY,
                'report_type_id' => IReportTypeEnum::ReportTypeIndustry,
                'name'           => trans(
                    IIndustryRatioReport::RatioNames[ IIndustryRatioReport::TaxRevenues ]
                ),
            ],
        ];

        ReportRatio::insert($ratios);
    }
}

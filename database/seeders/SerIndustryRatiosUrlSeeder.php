<?php

namespace Database\Seeders;

use App\Contracts\Taldau\ITaldauApiUrlContract;
use App\Models\Taldau\TaldauApiUrl;
use App\Repositories\Enums\Reports\IReportTypeEnum;
use App\Repositories\Enums\Reports\Ser\IIndustryRatioReport;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class SerIndustryRatiosUrlSeeder extends Seeder
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
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701647&p_keyword=&p_period_id=4&p_measure_id=5&p_term_id=741880&p_terms=741880,3079117&p_dicIds=68,4303&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeIndustry,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IIndustryRatioReport::EnterpriseNumber,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=702844&p_keyword=&p_period_id=5&p_measure_id=5&p_term_id=741880&p_terms=741880,741935&p_dicIds=67,576&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeIndustry,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IIndustryRatioReport::Employed,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=702972&p_keyword=&p_period_id=5&p_measure_id=1&p_term_id=741880&p_terms=741880,741885,741917,3629946&p_dicIds=68,859,776,2813&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeIndustry,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IIndustryRatioReport::AverageSalary,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,3079117,679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeIndustry,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IIndustryRatioReport::IndustrialProductionVolume,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                                                                . IIndustryRatioReport::IndustrialProductionVolumeIndustryIds[ IIndustryRatioReport::IndustrialProductionVolumeIndustryMining ]
                                                                . ',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeIndustry,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IIndustryRatioReport::IndustrialProductionVolumeIndustryMining,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                                                                . IIndustryRatioReport::IndustrialProductionVolumeIndustryIds[ IIndustryRatioReport::IndustrialProductionVolumeIndustryManufacturing ]
                                                                . ',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeIndustry,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IIndustryRatioReport::IndustrialProductionVolumeIndustryManufacturing,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                                                                . IIndustryRatioReport::IndustrialProductionVolumeIndustryIds[ IIndustryRatioReport::IndustrialProductionVolumeIndustrySupply ]
                                                                . ',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeIndustry,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IIndustryRatioReport::IndustrialProductionVolumeIndustrySupply,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                                                                . IIndustryRatioReport::IndustrialProductionVolumeIndustryIds[ IIndustryRatioReport::IndustrialProductionVolumeIndustryWaterAndWaste ]
                                                                . ',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeIndustry,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IIndustryRatioReport::IndustrialProductionVolumeIndustryWaterAndWaste,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,3078734,679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeIndustry,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IIndustryRatioReport::ManufacturingIndustryOutput,
            ],

            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                                                                . IIndustryRatioReport::ManufacturingIndustryStructureIds[ IIndustryRatioReport::ManufacturingIndustryStructureEngineering ]
                                                                .',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeIndustry,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IIndustryRatioReport::ManufacturingIndustryStructureEngineering,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                                                                . IIndustryRatioReport::ManufacturingIndustryStructureIds[ IIndustryRatioReport::ManufacturingIndustryStructureLight ]
                                                                .',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeIndustry,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IIndustryRatioReport::ManufacturingIndustryStructureLight,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                                                                . IIndustryRatioReport::ManufacturingIndustryStructureIds[ IIndustryRatioReport::ManufacturingIndustryStructureFood ]
                                                                .',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeIndustry,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IIndustryRatioReport::ManufacturingIndustryStructureFood,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                                                                . IIndustryRatioReport::ManufacturingIndustryStructureIds[ IIndustryRatioReport::ManufacturingIndustryStructureDrink ]
                                                                .',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeIndustry,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IIndustryRatioReport::ManufacturingIndustryStructureDrink,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                                                                . IIndustryRatioReport::ManufacturingIndustryStructureIds[ IIndustryRatioReport::ManufacturingIndustryStructureTobacco ]
                                                                .',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeIndustry,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IIndustryRatioReport::ManufacturingIndustryStructureTobacco,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                                                                . IIndustryRatioReport::ManufacturingIndustryStructureIds[ IIndustryRatioReport::ManufacturingIndustryStructureWoodAndCork ]
                                                                .',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeIndustry,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IIndustryRatioReport::ManufacturingIndustryStructureWoodAndCork,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                                                                . IIndustryRatioReport::ManufacturingIndustryStructureIds[ IIndustryRatioReport::ManufacturingIndustryStructurePaper ]
                                                                .',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeIndustry,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IIndustryRatioReport::ManufacturingIndustryStructurePaper,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                                                                . IIndustryRatioReport::ManufacturingIndustryStructureIds[ IIndustryRatioReport::ManufacturingIndustryStructurePrintingAndMedia ]
                                                                .',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeIndustry,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IIndustryRatioReport::ManufacturingIndustryStructurePrintingAndMedia,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                                                                . IIndustryRatioReport::ManufacturingIndustryStructureIds[ IIndustryRatioReport::ManufacturingIndustryStructurePetroleum ]
                                                                .',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeIndustry,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IIndustryRatioReport::ManufacturingIndustryStructurePetroleum,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                                                                . IIndustryRatioReport::ManufacturingIndustryStructureIds[ IIndustryRatioReport::ManufacturingIndustryStructureChemical ]
                                                                .',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeIndustry,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IIndustryRatioReport::ManufacturingIndustryStructureChemical,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                                                                . IIndustryRatioReport::ManufacturingIndustryStructureIds[ IIndustryRatioReport::ManufacturingIndustryStructurePharmaceutical ]
                                                                .',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeIndustry,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IIndustryRatioReport::ManufacturingIndustryStructurePharmaceutical,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                                                                . IIndustryRatioReport::ManufacturingIndustryStructureIds[ IIndustryRatioReport::ManufacturingIndustryStructureRubberAndPlastic ]
                                                                .',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeIndustry,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IIndustryRatioReport::ManufacturingIndustryStructureRubberAndPlastic,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                                                                . IIndustryRatioReport::ManufacturingIndustryStructureIds[ IIndustryRatioReport::ManufacturingIndustryStructureOtherNonMetal ]
                                                                .',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeIndustry,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IIndustryRatioReport::ManufacturingIndustryStructureOtherNonMetal,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                                                                . IIndustryRatioReport::ManufacturingIndustryStructureIds[ IIndustryRatioReport::ManufacturingIndustryStructureMetalProductsNonMachinery ]
                                                                .',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeIndustry,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IIndustryRatioReport::ManufacturingIndustryStructureMetalProductsNonMachinery,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                                                                . IIndustryRatioReport::ManufacturingIndustryStructureIds[ IIndustryRatioReport::ManufacturingIndustryStructureFurniture ]
                                                                .',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeIndustry,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IIndustryRatioReport::ManufacturingIndustryStructureFurniture,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                                                                . IIndustryRatioReport::ManufacturingIndustryStructureIds[ IIndustryRatioReport::ManufacturingIndustryStructureOther ]
                                                                .',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeIndustry,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IIndustryRatioReport::ManufacturingIndustryStructureOther,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701625&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,3079117,2695732&p_dicIds=68,4303,848&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeIndustry,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IIndustryRatioReport::PhysicalVolumeIndexIndustrialProduction,
            ],
            [
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                ITaldauApiUrlContract::FIELD_URL             => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701625&p_keyword=&p_period_id=4&p_measure_id=1&p_term_id=741880&p_terms=741880,3078734,2695732&p_dicIds=68,4303,848&idx=0&id=&levels=2,3',
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeIndustry,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IIndustryRatioReport::PhysicalVolumeIndexManufacturing,
            ],
        ];

        foreach ($ratios as $key => $ratio) {
            $ratios[ $key ][ ITaldauApiUrlContract::FIELD_ID ] = Uuid::uuid4();
        }

        TaldauApiUrl::insert($ratios);
    }
}

<?php

namespace Database\Seeders;

use App\Contracts\Taldau\ITaldauApiUrlContract;
use App\Models\Report\ReportRatio;
use App\Models\Taldau\TaldauApiUrl;
use App\Repositories\Enums\Reports\IReportTypeEnum;
use App\Repositories\Enums\Reports\Prt\IPrtReport;
use App\Repositories\Enums\Reports\Ser\IBusinessStatisticsRatioEnum;
use App\Repositories\Enums\Reports\Ser\IIndustryRatioReport;
use App\Repositories\Enums\Reports\Ser\IInvestmentReport;
use App\Repositories\Enums\Reports\Ser\ITradeRatioReport;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class SerPrtChangeMonthPeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    final public function run(): void
    {
        $ratios = [
            // IIndustryRatioReport
            [
                'id'  => IIndustryRatioReport::ManufacturingIndustryStructureEngineering,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                         . IIndustryRatioReport::ManufacturingIndustryStructureIds[ IIndustryRatioReport::ManufacturingIndustryStructureEngineering ]
                         . ',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IIndustryRatioReport::ManufacturingIndustryStructureLight,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                         . IIndustryRatioReport::ManufacturingIndustryStructureIds[ IIndustryRatioReport::ManufacturingIndustryStructureLight ]
                         . ',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IIndustryRatioReport::ManufacturingIndustryStructureFood,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                         . IIndustryRatioReport::ManufacturingIndustryStructureIds[ IIndustryRatioReport::ManufacturingIndustryStructureFood ]
                         . ',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IIndustryRatioReport::ManufacturingIndustryStructureDrink,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                         . IIndustryRatioReport::ManufacturingIndustryStructureIds[ IIndustryRatioReport::ManufacturingIndustryStructureDrink ]
                         . ',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IIndustryRatioReport::ManufacturingIndustryStructureTobacco,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                         . IIndustryRatioReport::ManufacturingIndustryStructureIds[ IIndustryRatioReport::ManufacturingIndustryStructureTobacco ]
                         . ',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IIndustryRatioReport::ManufacturingIndustryStructureWoodAndCork,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                         . IIndustryRatioReport::ManufacturingIndustryStructureIds[ IIndustryRatioReport::ManufacturingIndustryStructureWoodAndCork ]
                         . ',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IIndustryRatioReport::ManufacturingIndustryStructurePaper,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                         . IIndustryRatioReport::ManufacturingIndustryStructureIds[ IIndustryRatioReport::ManufacturingIndustryStructurePaper ]
                         . ',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IIndustryRatioReport::ManufacturingIndustryStructurePrintingAndMedia,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                         . IIndustryRatioReport::ManufacturingIndustryStructureIds[ IIndustryRatioReport::ManufacturingIndustryStructurePrintingAndMedia ]
                         . ',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IIndustryRatioReport::ManufacturingIndustryStructurePetroleum,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                         . IIndustryRatioReport::ManufacturingIndustryStructureIds[ IIndustryRatioReport::ManufacturingIndustryStructurePetroleum ]
                         . ',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IIndustryRatioReport::ManufacturingIndustryStructureChemical,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                         . IIndustryRatioReport::ManufacturingIndustryStructureIds[ IIndustryRatioReport::ManufacturingIndustryStructureChemical ]
                         . ',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IIndustryRatioReport::ManufacturingIndustryStructurePharmaceutical,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                         . IIndustryRatioReport::ManufacturingIndustryStructureIds[ IIndustryRatioReport::ManufacturingIndustryStructurePharmaceutical ]
                         . ',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IIndustryRatioReport::ManufacturingIndustryStructureRubberAndPlastic,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                         . IIndustryRatioReport::ManufacturingIndustryStructureIds[ IIndustryRatioReport::ManufacturingIndustryStructureRubberAndPlastic ]
                         . ',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IIndustryRatioReport::ManufacturingIndustryStructureOtherNonMetal,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                         . IIndustryRatioReport::ManufacturingIndustryStructureIds[ IIndustryRatioReport::ManufacturingIndustryStructureOtherNonMetal ]
                         . ',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IIndustryRatioReport::ManufacturingIndustryStructureMetalProductsNonMachinery,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                         . IIndustryRatioReport::ManufacturingIndustryStructureIds[ IIndustryRatioReport::ManufacturingIndustryStructureMetalProductsNonMachinery ]
                         . ',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IIndustryRatioReport::ManufacturingIndustryStructureFurniture,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                         . IIndustryRatioReport::ManufacturingIndustryStructureIds[ IIndustryRatioReport::ManufacturingIndustryStructureFurniture ]
                         . ',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IIndustryRatioReport::ManufacturingIndustryStructureOther,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                         . IIndustryRatioReport::ManufacturingIndustryStructureIds[ IIndustryRatioReport::ManufacturingIndustryStructureOther ]
                         . ',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IIndustryRatioReport::ManufacturingIndustryStructureMetallurgical,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                         . IIndustryRatioReport::ManufacturingIndustryStructureIds[ IIndustryRatioReport::ManufacturingIndustryStructureMetallurgical ]
                         . ',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IIndustryRatioReport::IndustrialProductionVolumeIndustryMining,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                         . IIndustryRatioReport::IndustrialProductionVolumeIndustryIds[ IIndustryRatioReport::IndustrialProductionVolumeIndustryMining ]
                         . ',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IIndustryRatioReport::IndustrialProductionVolumeIndustryManufacturing,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                         . IIndustryRatioReport::IndustrialProductionVolumeIndustryIds[ IIndustryRatioReport::IndustrialProductionVolumeIndustryManufacturing ]
                         . ',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IIndustryRatioReport::IndustrialProductionVolumeIndustrySupply,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                         . IIndustryRatioReport::IndustrialProductionVolumeIndustryIds[ IIndustryRatioReport::IndustrialProductionVolumeIndustrySupply ]
                         . ',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IIndustryRatioReport::IndustrialProductionVolumeIndustryWaterAndWaste,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                         . IIndustryRatioReport::IndustrialProductionVolumeIndustryIds[ IIndustryRatioReport::IndustrialProductionVolumeIndustryWaterAndWaste ]
                         . ',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IIndustryRatioReport::IndustrialProductionVolume,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,3079117,679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IIndustryRatioReport::ManufacturingIndustryOutput,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,3078734,679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IIndustryRatioReport::PhysicalVolumeIndexIndustrialProduction,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701625&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,3079117,2695732&p_dicIds=68,4303,848&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IIndustryRatioReport::PhysicalVolumeIndexManufacturing,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701625&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,3078734,2695732&p_dicIds=68,4303,848&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => ITradeRatioReport::TradeWholesaleTurnover,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=702020&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741879&p_dicIds=68,316&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => ITradeRatioReport::TradeWholesalePhysicalVolumeIndex,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=268020&p_index_id=702022&p_keyword=&p_period_id=8&p_measure_id=7&p_term_id=741880&p_terms=741880,741879,2695732&p_dicIds=68,316,848&idx=0&id=268020&levels=2,3',
            ],
            [
                'id'  => ITradeRatioReport::TradeWholesaleTurnoverByDistrict,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=268020&p_index_id=702020&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741879&p_dicIds=68,316&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => ITradeRatioReport::TradeRetailTurnover,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=702038&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741927&p_dicIds=68,90&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => ITradeRatioReport::TradeRetailPhysicalVolumeIndex,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=702041&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741879,2695732&p_dicIds=67,316,848&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => ITradeRatioReport::TradeWholesaleStructureFood,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=702020&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880%2C741917%2C18224345&p_dicIds=67%2C749%2C3013&idx=0&id=741880',
            ],
            [
                'id'  => ITradeRatioReport::TradeWholesaleStructureNonFood,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=702020&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880%2C741917%2C18224350&p_dicIds=67%2C749%2C3013&idx=0&id=741880',
            ],
            [
                'id'  => ITradeRatioReport::TradeRetailStructureFood,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=702038&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880%2C741917%2C18224345&p_dicIds=67%2C749%2C3013&idx=0',
            ],
            [
                'id'  => ITradeRatioReport::TradeRetailStructureNonFood,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=702038&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880%2C741917%2C18224350&p_dicIds=67%2C749%2C3013&idx=0',
            ],
            [
                'id'  => IInvestmentReport::InvestmentSize,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741885,808076&p_dicIds=68,1212,681&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IInvestmentReport::InternalInvestment,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=2970832&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741927&p_dicIds=68,90&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IInvestmentReport::ExternalInvestment,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=2970833&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741927&p_dicIds=68,90&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IInvestmentReport::InvestmentVolumeByActivityIndustry,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741927,807855,'
                         . IInvestmentReport::InvestmentVolumeByActivityIds[ IInvestmentReport::InvestmentVolumeByActivityIndustry ]
                         . '&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IInvestmentReport::InvestmentVolumeByActivityForestAndFishing,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741927,807855,'
                         . IInvestmentReport::InvestmentVolumeByActivityIds[ IInvestmentReport::InvestmentVolumeByActivityForestAndFishing ]
                         . '&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IInvestmentReport::InvestmentVolumeByActivityBuild,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741927,807855,'
                         . IInvestmentReport::InvestmentVolumeByActivityIds[ IInvestmentReport::InvestmentVolumeByActivityBuild ]
                         . '&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IInvestmentReport::InvestmentVolumeByActivityTradeAndRepair,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741927,807855,'
                         . IInvestmentReport::InvestmentVolumeByActivityIds[ IInvestmentReport::InvestmentVolumeByActivityTradeAndRepair ]
                         . '&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IInvestmentReport::InvestmentVolumeByActivityLogistic,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741927,807855,'
                         . IInvestmentReport::InvestmentVolumeByActivityIds[ IInvestmentReport::InvestmentVolumeByActivityLogistic ]
                         . '&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IInvestmentReport::InvestmentVolumeByActivityAccommodationAndFood,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741927,807855,'
                         . IInvestmentReport::InvestmentVolumeByActivityIds[ IInvestmentReport::InvestmentVolumeByActivityAccommodationAndFood ]
                         . '&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IInvestmentReport::InvestmentVolumeByActivityInformAndCommunication,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741927,807855,'
                         . IInvestmentReport::InvestmentVolumeByActivityIds[ IInvestmentReport::InvestmentVolumeByActivityInformAndCommunication ]
                         . '&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IInvestmentReport::InvestmentVolumeByActivityFinanceAndInsurance,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741927,807855,'
                         . IInvestmentReport::InvestmentVolumeByActivityIds[ IInvestmentReport::InvestmentVolumeByActivityFinanceAndInsurance ]
                         . '&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IInvestmentReport::InvestmentVolumeByActivityRealEstate,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741927,807855,'
                         . IInvestmentReport::InvestmentVolumeByActivityIds[ IInvestmentReport::InvestmentVolumeByActivityRealEstate ]
                         . '&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IInvestmentReport::InvestmentVolumeByActivityScience,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741927,807855,'
                         . IInvestmentReport::InvestmentVolumeByActivityIds[ IInvestmentReport::InvestmentVolumeByActivityScience ]
                         . '&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IInvestmentReport::InvestmentVolumeByActivityAdministrateAndSupport,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741927,807855,'
                         . IInvestmentReport::InvestmentVolumeByActivityIds[ IInvestmentReport::InvestmentVolumeByActivityAdministrateAndSupport ]
                         . '&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IInvestmentReport::InvestmentVolumeByActivityGovernmentAndDefence,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741927,807855,'
                         . IInvestmentReport::InvestmentVolumeByActivityIds[ IInvestmentReport::InvestmentVolumeByActivityGovernmentAndDefence ]
                         . '&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IInvestmentReport::InvestmentVolumeByActivityEducation,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741927,807855,'
                         . IInvestmentReport::InvestmentVolumeByActivityIds[ IInvestmentReport::InvestmentVolumeByActivityEducation ]
                         . '&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IInvestmentReport::InvestmentVolumeByActivityHealthCare,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741927,807855,'
                         . IInvestmentReport::InvestmentVolumeByActivityIds[ IInvestmentReport::InvestmentVolumeByActivityHealthCare ]
                         . '&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IInvestmentReport::InvestmentVolumeByActivityArtsAndEntertainment,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741927,807855,'
                         . IInvestmentReport::InvestmentVolumeByActivityIds[ IInvestmentReport::InvestmentVolumeByActivityArtsAndEntertainment ]
                         . '&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IInvestmentReport::InvestmentVolumeByActivityOther,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741927,807855,'
                         . IInvestmentReport::InvestmentVolumeByActivityIds[ IInvestmentReport::InvestmentVolumeByActivityOther ]
                         . '&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IInvestmentReport::InvestmentByDistrict,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741885,808076&p_dicIds=68,1212,681&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IInvestmentReport::InvestmentBySizeOfEnterprisesSmall,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,'
                         . IInvestmentReport::InvestmentBySizeOfEnterprisesIds[ IInvestmentReport::InvestmentBySizeOfEnterprisesSmall ]
                         . ',807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IInvestmentReport::InvestmentBySizeOfEnterprisesMedium,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,'
                         . IInvestmentReport::InvestmentBySizeOfEnterprisesIds[ IInvestmentReport::InvestmentBySizeOfEnterprisesMedium ]
                         . ',807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IInvestmentReport::InvestmentBySizeOfEnterprisesLarge,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,'
                         . IInvestmentReport::InvestmentBySizeOfEnterprisesIds[ IInvestmentReport::InvestmentBySizeOfEnterprisesLarge ]
                         . ',807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IInvestmentReport::InvestmentOwn,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=19806558&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741907,451902&p_dicIds=68,59,459&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IInvestmentReport::InvestmentLoan,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=19806558&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741907,3767702&p_dicIds=68,59,459&idx=0&id=&levels=2,3',
            ],
        ];

        foreach ($ratios as $ratio) {
            $item = TaldauApiUrl::where('report_ratio_id', $ratio[ 'id' ])
                                ->first()
            ;
            if ($item) {
                $item->fill($ratio);
                $item->save();
            }
        }

        $prtRatios = [
            [
                'id'  => IPrtReport::PhysicalVolumeIndexProcessingIndustrialFact,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701625&p_keyword=&p_period_id=8&p_measure_id=7&p_term_id=741880&p_terms=741880%2C3078734%2C2695732&p_dicIds=68%2C4303%2C848&idx=0',
            ],
            [
                'id'  => IPrtReport::IfoProcessingIndustrialDynamic,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701625&p_keyword=&p_period_id=8&p_measure_id=7&p_term_id=741880&p_terms=741880,3078734,2695732&p_dicIds=68,4303,848&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::MainCapitalInvestmentsFact,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::IndustryIfoIndustryIndustrial,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=8&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::IndustryIfoIndustryForestAndFishing,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=8&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::IndustryIfoIndustryBuild,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=8&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::IndustryIfoIndustryTradeAndRepair,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=8&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::IndustryIfoIndustryLogistic,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=8&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::IndustryIfoIndustryAccommodationAndFood,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=8&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::IndustryIfoIndustryInformAndCommunication,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=8&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::IndustryIfoIndustryFinanceAndInsurance,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=8&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::IndustryIfoIndustryRealEstate,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=8&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::IndustryIfoIndustryScience,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=8&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::IndustryIfoIndustryAdministrateAndSupport,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=8&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::IndustryIfoIndustryGovernmentAndDefence,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=8&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::IndustryIfoIndustryEducation,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=8&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::IndustryIfoIndustryHealthCare,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=8&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::IndustryIfoIndustryArtsAndEntertainment,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=8&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::IndustryIfoIndustryOther,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=8&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::IndustryIfoIndustryHouseHold,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=8&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::IndustryIfoIndustryExtraterritorial,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=8&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::IndustryIfoIndustryMining,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=8&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::IndustryIfoIndustryManufacture,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=8&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::IndustryIfoIndustrySupply,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=8&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::IndustryIfoIndustryWaste,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701851&p_keyword=&p_period_id=8&p_measure_id=7&p_term_id=741885&p_terms=268020,741885,741927,2695732&p_dicIds=68,1212,90,848&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::Top5IndustryInvestIndustrial,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::Top5IndustryInvestForestAndFishing,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::Top5IndustryInvestBuild,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::Top5IndustryInvestTradeAndRepair,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::Top5IndustryInvestLogistic,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::Top5IndustryInvestAccommodationAndFood,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::Top5IndustryInvestInformAndCommunication,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::Top5IndustryInvestFinanceAndInsurance,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::Top5IndustryInvestRealEstate,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::Top5IndustryInvestScience,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::Top5IndustryInvestAdministrateAndSupport,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::Top5IndustryInvestGovernmentAndDefence,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::Top5IndustryInvestEducation,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::Top5IndustryInvestHealthCare,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::Top5IndustryInvestArtsAndEntertainment,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::Top5IndustryInvestOther,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::Top5IndustryInvestHouseHold,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::Top5IndustryInvestExtraterritorial,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::Top5IndustryInvestMining,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::Top5IndustryInvestManufacture,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::Top5IndustryInvestSupply,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
            [
                'id'  => IPrtReport::Top5IndustryInvestWaste,
                'url' => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741885&p_index_id=701830&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741885&p_terms=268020,741927,807855,741885&p_dicIds=68,90,459,3028&idx=0&id=&levels=2,3',
            ],
        ];

        foreach ($prtRatios as $ratio) {
            $ratioCount = TaldauApiUrl::where('report_ratio_id', $ratio[ 'id' ])
                                      ->count()
            ;

            while ($ratioCount > 1) {
                $last = TaldauApiUrl::where('report_ratio_id', $ratio[ 'id' ])
                                    ->get()
                                    ->last()
                ;
                $last->delete();

                $ratioCount = TaldauApiUrl::where('report_ratio_id', $ratio[ 'id' ])
                                          ->count()
                ;
            }

            $item = TaldauApiUrl::where('report_ratio_id', $ratio[ 'id' ])
                                ->first()
            ;
            if ($item) {
                $item->fill($ratio);
                $item->save();
            }
        }

        $remove = TaldauApiUrl::where(ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID, IPrtReport::Top5IndustryIfoUp)->get();
        foreach ($remove as $item)
        {
            $item->delete();
        }

        $addRatios = [
            [
                ITaldauApiUrlContract::FIELD_REPORT_TYPE_ID  => IReportTypeEnum::ReportTypeIndustry,
                ITaldauApiUrlContract::FIELD_REPORT_RATIO_ID => IIndustryRatioReport::ManufacturingIndustryStructureMetallurgical,
                ITaldauApiUrlContract::FIELD_IS_ACTIVE       => true,
                'url'                                        => 'https://taldau.stat.gov.kz/ru/Api/GetIndexTreeData?p_parent_id=741880&p_index_id=701592&p_keyword=&p_period_id=8&p_measure_id=1&p_term_id=741880&p_terms=741880,741917,'
                                                                . IIndustryRatioReport::ManufacturingIndustryStructureIds[ IIndustryRatioReport::ManufacturingIndustryStructureMetallurgical ]
                                                                . ',679489&p_dicIds=68,776,4303,524&idx=0&id=&levels=2,3',
            ],
        ];

        foreach ($addRatios as $ratio) {
            $exists = TaldauApiUrl::where('report_ratio_id', $ratio[ 'report_ratio_id' ])
                                  ->first()
            ;
            if (!$exists) {
                $ratio[ 'id' ] = Uuid::uuid4();
                TaldauApiUrl::create($ratio);
            }
        }

    }
}

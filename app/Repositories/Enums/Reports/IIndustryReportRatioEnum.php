<?php

namespace App\Repositories\Enums\Reports;

// TODO remove contract
interface IIndustryReportRatioEnum
{

    public const PhysicalVolumeIndexByDistricts                      = '7a020b5e-d7ce-4294-b96a-0630b30dfc69';
    public const Top5IndustriesByGrowth                              = '22f1b485-8390-4bfa-933c-98fa968e6d66';
    public const Top5IndustriesByFall                                = '2ff5508c-2fdc-4056-8914-653e9244303f';
    public const Top5IndustriesPaper                                 = '4d855aea-9d21-4ebe-9703-960ac6a400d9';
    public const Top5IndustriesMetal                                 = '3a71cb01-79f6-4ccc-9c7a-e0dbbbfe4929';
    public const Top5IndustriesMechanical                            = 'fd75e9a8-bd79-4022-ba9f-f9b463925f79';
    public const Top5IndustriesPharma                                = 'd0778c81-8fcb-4ba3-bf23-792e74d61b05';
    public const Top5IndustriesDrink                                 = 'f4685678-8712-4c34-8f1b-38ffb89e785a';
    public const Top5IndustriesOther                                 = 'dce86dfa-bcba-4743-8edb-6540a873dc15';
    public const Top5IndustriesMetallurgy                            = '1d3587ae-79fd-4dc8-92e8-02cda2dc9bf2';
    public const Top5IndustriesPrint                                 = '31276dc7-2bfb-4822-89ee-3025ca66a7cf';
    public const Top5IndustriesFood                                  = '68773f1c-da7c-41bb-919c-7995f147f3db';
    public const InvestmentsInManufacturingIndustry                  = '6c1b95b7-a60c-4ca7-bff4-ee3cb9b46f6e';
    public const Performance                                         = 'f5b6ffad-aeb7-4e7d-ae7b-ee100d11212c';
    public const ProductionByIndustries                              = '3cbd30f2-8415-4ed9-b9c9-d049a7ee884b';
    public const ProductionByIndustriesPaper                         = 'f2a2aee7-9a84-4de3-9140-feb3eca31115';
    public const ProductionByIndustriesMetal                         = '2884766f-0df4-41f8-a385-666aa6f28546';
    public const ProductionByIndustriesMechanical                    = 'bc1f0f77-a267-445a-87f6-0ff915df1cff';
    public const ProductionByIndustriesPharma                        = 'e6a5b6bb-41e9-429a-9a77-e7e627df8823';
    public const ProductionByIndustriesDrink                         = 'c19c4c5d-0bb6-4959-8db0-d6c99a6d6c96';
    public const ProductionByIndustriesOther                         = '91d6a91e-75de-4187-8a21-faaf5258f920';
    public const ProductionByIndustriesMetallurgy                    = 'f35918f1-15e0-4b85-8b08-21be5c93231e';
    public const ProductionByIndustriesPrint                         = '9d4fe766-ec47-4dbb-8adb-2cd60c7744b4';
    public const ProductionByIndustriesFood                          = '60d89545-8948-4b61-8c99-8fb27c8e2272';
    public const ProductionVolumeByDistricts                         = '8c02d875-360e-4b30-bcfc-3fd274c6ec98';
    public const InvestmentsInManufacturingIndustryByDistricts       = '044adcf9-97b3-4433-ad91-9521760029ad';
    public const DynamicsOfProductionGrowth                          = 'a94bdf19-9a2c-4214-908b-eccfd7dd1f9f';
    public const DynamicsOfProductionGrowthYearFirst                 = '016e6ce9-aa81-4af7-bcc3-ed3d447a1d42';
    public const DynamicsOfProductionGrowthYearSecond                = '04b94781-aef4-4640-901b-90e0c934018e';
    public const DynamicsOfProductionGrowthYearThird                 = '21794910-6bdd-45bb-b49d-c05402ee72a5';
    public const DynamicsOfProductionGrowthValueFirst                = '393fc360-7198-4cf3-94c8-13e37f6e6a74';
    public const DynamicsOfProductionGrowthValueSecond               = '7adc00eb-837c-4865-bdc9-3e6e972695ae';
    public const DynamicsOfProductionGrowthValueThird                = '12320fb4-7888-439f-bbf9-30d8e8f9e858';
    public const FixedCapitalInvestmentsByTypeOfProduction           = '9245da1d-6b33-4ba3-a206-02e2e86f1a41';
    public const FixedCapitalInvestmentsByTypeOfProductionPaper      = '595388f9-beac-448d-a0e9-e36eed143a33';
    public const FixedCapitalInvestmentsByTypeOfProductionMetal      = 'dfe6d946-5cf9-4ab0-8f11-20907c66f73a';
    public const FixedCapitalInvestmentsByTypeOfProductionMechanical = '4dfdc562-e37d-47bb-949f-af6c5ca11021';
    public const FixedCapitalInvestmentsByTypeOfProductionPharma     = '5d8abc17-afbe-4ddd-bc2d-1ebd18dc9369';
    public const FixedCapitalInvestmentsByTypeOfProductionDrink      = '41f291ab-58b2-43d9-84a3-9d606d17ef59';
    public const FixedCapitalInvestmentsByTypeOfProductionOther      = '9d73b1ca-fc8a-4d5e-b6f8-4b743547a335';
    public const FixedCapitalInvestmentsByTypeOfProductionMetallurgy = '44cb72dc-35b2-4155-af3f-d11bc58489a4';
    public const FixedCapitalInvestmentsByTypeOfProductionPrint      = '1904dcbc-1692-43f9-9ea3-6c69d217103a';
    public const FixedCapitalInvestmentsByTypeOfProductionFood       = 'f40b89fe-e885-45e1-b3ae-3610e5dc570d';
    public const ProductivityByTypeOfProduction                      = '9a38327e-802b-462c-8077-70ab258c9482';
    public const ProductivityByTypeOfProductionPaper                 = '2d8bdcf6-9c82-4ad1-ad00-5c9f5a52e72c';
    public const ProductivityByTypeOfProductionMetal                 = '89012e50-74d9-43d8-8815-541e023a1ff0';
    public const ProductivityByTypeOfProductionMechanical            = '0a087319-7b9f-4e2c-9a02-f597699e777f';
    public const ProductivityByTypeOfProductionPharma                = '4c0e7e42-a8e3-4801-9943-2e6fa99fef33';
    public const ProductivityByTypeOfProductionDrink                 = '44ad54b8-99da-4c56-9995-0d94fe196f24';
    public const ProductivityByTypeOfProductionOther                 = '762b66a6-254f-4908-89e1-d62ea7d277ef';
    public const ProductivityByTypeOfProductionMetallurgy            = '49e740a2-73ad-4ad4-8b6d-1e311454c7b2';
    public const ProductivityByTypeOfProductionPrint                 = 'e087cba2-a773-4d6c-a0b8-759a85ae5508';
    public const ProductivityByTypeOfProductionFood                  = '616cfdfc-c1d3-42e1-8573-b599d1b0f757';

    public const PhysicalVolumeIndexByDistrictsName                = 'report.Industry.PhysicalVolumeIndexByDistrictsName';
    public const Top5IndustriesName                                = 'report.Industry.Top5IndustriesName';
    public const InvestmentsInManufacturingIndustryName            = 'report.Industry.InvestmentsInManufacturingIndustryName';
    public const PerformanceName                                   = 'report.Industry.PerformanceName';
    public const ProductionByIndustriesName                        = 'report.Industry.ProductionByIndustriesName';
    public const ProductionVolumeByDistrictsName                   = 'report.Industry.ProductionVolumeByDistrictsName';
    public const InvestmentsInManufacturingIndustryByDistrictsName = 'report.Industry.InvestmentsInManufacturingIndustryByDistrictsName';
    public const DynamicsOfProductionGrowthName                    = 'report.Industry.DynamicsOfProductionGrowthName';
    public const FixedCapitalInvestmentsByTypeOfProductionName     = 'report.Industry.FixedCapitalInvestmentsByTypeOfProductionName';
    public const ProductivityByTypeOfProductionName                = 'report.Industry.ProductivityByTypeOfProductionName';
    public const ProductivityByTypeOfProductionNameShort           = 'report.Industry.ProductivityByTypeOfProductionNameShort';
    public const PaperName                                         = 'report.Industry.PaperName';
    public const MetalName                                         = 'report.Industry.MetalName';
    public const MechanicalName                                    = 'report.Industry.MechanicalName';
    public const PharmaName                                        = 'report.Industry.PharmaName';
    public const DrinkName                                         = 'report.Industry.DrinkName';
    public const OtherName                                         = 'report.Industry.OtherName';
    public const MetallurgyName                                    = 'report.Industry.MetallurgyName';
    public const PrintName                                         = 'report.Industry.PrintName';
    public const FoodName                                          = 'report.Industry.FoodName';
    public const DynamicsOfProductionGrowthYearFirstName           = 'report.Industry.DynamicsOfProductionGrowthYearFirstName';
    public const DynamicsOfProductionGrowthYearSecondName          = 'report.Industry.DynamicsOfProductionGrowthYearSecondName';
    public const DynamicsOfProductionGrowthYearThirdName           = 'report.Industry.DynamicsOfProductionGrowthYearThirdName';
    public const DynamicsOfProductionGrowthValueFirstName          = 'report.Industry.DynamicsOfProductionGrowthValueFirstName';
    public const DynamicsOfProductionGrowthValueSecondName         = 'report.Industry.DynamicsOfProductionGrowthValueSecondName';
    public const DynamicsOfProductionGrowthValueThirdName          = 'report.Industry.DynamicsOfProductionGrowthValueThirdName';


    public const VIRTUAL_RATIOS = [
        self::PhysicalVolumeIndexByDistricts,
        self::Top5IndustriesByGrowth,
        self::Top5IndustriesByFall,
        self::ProductionByIndustries,
        self::ProductionVolumeByDistricts,
        self::InvestmentsInManufacturingIndustryByDistricts,
        self::DynamicsOfProductionGrowth,
        self::FixedCapitalInvestmentsByTypeOfProduction,
        self::ProductivityByTypeOfProduction,
    ];

    public const CITY_RATIOS_LIST = [
        self::InvestmentsInManufacturingIndustry,
        self::Performance,
        self::DynamicsOfProductionGrowthYearFirst,
        self::DynamicsOfProductionGrowthValueFirst,
        self::DynamicsOfProductionGrowthYearSecond,
        self::DynamicsOfProductionGrowthValueSecond,
        self::DynamicsOfProductionGrowthYearThird,
        self::DynamicsOfProductionGrowthValueThird,
    ];

    public const ProductionByIndustriesList = [
        self::ProductionByIndustriesPaper,
        self::ProductionByIndustriesMetal,
        self::ProductionByIndustriesMechanical,
        self::ProductionByIndustriesPharma,
        self::ProductionByIndustriesDrink,
        self::ProductionByIndustriesOther,
        self::ProductionByIndustriesMetallurgy,
        self::ProductionByIndustriesPrint,
        self::ProductionByIndustriesFood,
    ];

    public const FixedCapitalInvestmentsByTypeOfProductionList = [
        self::FixedCapitalInvestmentsByTypeOfProductionPaper,
        self::FixedCapitalInvestmentsByTypeOfProductionMetal,
        self::FixedCapitalInvestmentsByTypeOfProductionMechanical,
        self::FixedCapitalInvestmentsByTypeOfProductionPharma,
        self::FixedCapitalInvestmentsByTypeOfProductionDrink,
        self::FixedCapitalInvestmentsByTypeOfProductionOther,
        self::FixedCapitalInvestmentsByTypeOfProductionMetallurgy,
        self::FixedCapitalInvestmentsByTypeOfProductionPrint,
        self::FixedCapitalInvestmentsByTypeOfProductionFood,
    ];

    public const ProductivityByTypeOfProductionList = [
        self::ProductivityByTypeOfProductionPaper,
        self::ProductivityByTypeOfProductionMetal,
        self::ProductivityByTypeOfProductionMechanical,
        self::ProductivityByTypeOfProductionPharma,
        self::ProductivityByTypeOfProductionDrink,
        self::ProductivityByTypeOfProductionOther,
        self::ProductivityByTypeOfProductionMetallurgy,
        self::ProductivityByTypeOfProductionPrint,
        self::ProductivityByTypeOfProductionFood,
    ];

    public const CITY_RATIOS_LIST_PLAIN = [
        self::InvestmentsInManufacturingIndustry,
        self::Performance,
    ];

    public const Top5IndustriesList     = [
        self::Top5IndustriesPaper,
        self::Top5IndustriesMetal,
        self::Top5IndustriesMechanical,
        self::Top5IndustriesPharma,
        self::Top5IndustriesDrink,
        self::Top5IndustriesOther,
        self::Top5IndustriesMetallurgy,
        self::Top5IndustriesPrint,
        self::Top5IndustriesFood,
    ];
    public const IndustriesNamesList    = [
        self::Top5IndustriesPaper      => self::PaperName,
        self::Top5IndustriesMetal      => self::MetalName,
        self::Top5IndustriesMechanical => self::MechanicalName,
        self::Top5IndustriesPharma     => self::PharmaName,
        self::Top5IndustriesDrink      => self::DrinkName,
        self::Top5IndustriesOther      => self::OtherName,
        self::Top5IndustriesMetallurgy => self::MetallurgyName,
        self::Top5IndustriesPrint      => self::PrintName,
        self::Top5IndustriesFood       => self::FoodName,

        self::ProductionByIndustriesPaper      => self::PaperName,
        self::ProductionByIndustriesMetal      => self::MetalName,
        self::ProductionByIndustriesMechanical => self::MechanicalName,
        self::ProductionByIndustriesPharma     => self::PharmaName,
        self::ProductionByIndustriesDrink      => self::DrinkName,
        self::ProductionByIndustriesOther      => self::OtherName,
        self::ProductionByIndustriesMetallurgy => self::MetallurgyName,
        self::ProductionByIndustriesPrint      => self::PrintName,
        self::ProductionByIndustriesFood       => self::FoodName,

        self::FixedCapitalInvestmentsByTypeOfProductionPaper      => self::PaperName,
        self::FixedCapitalInvestmentsByTypeOfProductionMetal      => self::MetalName,
        self::FixedCapitalInvestmentsByTypeOfProductionMechanical => self::MechanicalName,
        self::FixedCapitalInvestmentsByTypeOfProductionPharma     => self::PharmaName,
        self::FixedCapitalInvestmentsByTypeOfProductionDrink      => self::DrinkName,
        self::FixedCapitalInvestmentsByTypeOfProductionOther      => self::OtherName,
        self::FixedCapitalInvestmentsByTypeOfProductionMetallurgy => self::MetallurgyName,
        self::FixedCapitalInvestmentsByTypeOfProductionPrint      => self::PrintName,
        self::FixedCapitalInvestmentsByTypeOfProductionFood       => self::FoodName,

        self::ProductivityByTypeOfProductionPaper      => self::PaperName,
        self::ProductivityByTypeOfProductionMetal      => self::MetalName,
        self::ProductivityByTypeOfProductionMechanical => self::MechanicalName,
        self::ProductivityByTypeOfProductionPharma     => self::PharmaName,
        self::ProductivityByTypeOfProductionDrink      => self::DrinkName,
        self::ProductivityByTypeOfProductionOther      => self::OtherName,
        self::ProductivityByTypeOfProductionMetallurgy => self::MetallurgyName,
        self::ProductivityByTypeOfProductionPrint      => self::PrintName,
        self::ProductivityByTypeOfProductionFood       => self::FoodName,
    ];

    public const OldRatios = [
        self::PhysicalVolumeIndexByDistricts,
        self::Top5IndustriesByGrowth,
        self::Top5IndustriesByFall,
        self::Top5IndustriesPaper,
        self::Top5IndustriesMetal,
        self::Top5IndustriesMechanical,
        self::Top5IndustriesPharma,
        self::Top5IndustriesDrink,
        self::Top5IndustriesOther,
        self::Top5IndustriesMetallurgy,
        self::Top5IndustriesPrint,
        self::Top5IndustriesFood,
        self::InvestmentsInManufacturingIndustry,
        self::Performance,
        self::ProductionByIndustries,
        self::ProductionByIndustriesPaper,
        self::ProductionByIndustriesMetal,
        self::ProductionByIndustriesMechanical,
        self::ProductionByIndustriesPharma,
        self::ProductionByIndustriesDrink,
        self::ProductionByIndustriesOther,
        self::ProductionByIndustriesMetallurgy,
        self::ProductionByIndustriesPrint,
        self::ProductionByIndustriesFood,
        self::ProductionVolumeByDistricts,
        self::InvestmentsInManufacturingIndustryByDistricts,
        self::DynamicsOfProductionGrowth,
        self::DynamicsOfProductionGrowthYearFirst,
        self::DynamicsOfProductionGrowthYearSecond,
        self::DynamicsOfProductionGrowthYearThird,
        self::DynamicsOfProductionGrowthValueFirst,
        self::DynamicsOfProductionGrowthValueSecond,
        self::DynamicsOfProductionGrowthValueThird,
        self::FixedCapitalInvestmentsByTypeOfProduction,
        self::FixedCapitalInvestmentsByTypeOfProductionPaper,
        self::FixedCapitalInvestmentsByTypeOfProductionMetal,
        self::FixedCapitalInvestmentsByTypeOfProductionMechanical,
        self::FixedCapitalInvestmentsByTypeOfProductionPharma,
        self::FixedCapitalInvestmentsByTypeOfProductionDrink,
        self::FixedCapitalInvestmentsByTypeOfProductionOther,
        self::FixedCapitalInvestmentsByTypeOfProductionMetallurgy,
        self::FixedCapitalInvestmentsByTypeOfProductionPrint,
        self::FixedCapitalInvestmentsByTypeOfProductionFood,
        self::ProductivityByTypeOfProduction,
        self::ProductivityByTypeOfProductionPaper,
        self::ProductivityByTypeOfProductionMetal,
        self::ProductivityByTypeOfProductionMechanical,
        self::ProductivityByTypeOfProductionPharma,
        self::ProductivityByTypeOfProductionDrink,
        self::ProductivityByTypeOfProductionOther,
        self::ProductivityByTypeOfProductionMetallurgy,
        self::ProductivityByTypeOfProductionPrint,
        self::ProductivityByTypeOfProductionFood,
    ];

}

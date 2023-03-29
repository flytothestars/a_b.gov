<?php

namespace App\Repositories\Enums\Reports\Ser;

interface IIndustryRatioReport
{
    public const  EnterpriseNumber                                        = '9373d291-2c97-447a-8e90-60c661ea399e';     // 1 Количество предприятий
    public const  Employed                                                = '8f000f15-15d2-4619-8ccb-3fb691eb9ab5';     // 2 Численность занятых
    public const  AverageSalary                                           = '5a076f88-afad-404d-8ec7-5c2a7ea99bf3';     // 3 Средняя зарплата
    public const  TaxRevenues                                             = '07094b24-57b7-405b-8d54-08c1cc923651';     // 4 Налоговые поступления
    public const  IndustrialProductionVolume                              = '39ec1428-ee55-47bf-8b76-d7629bbf2912';     // 5 Объем промышленного производства
    public const  IndustrialProductionVolumeIndustry                      = 'e1655d83-35d9-4423-a5a5-951b6011514e';     // 6 Объем промышленного производства по отраслям
    public const  IndustrialProductionVolumeIndustryMining                = '7684d500-a3af-4490-b844-3be957bac10b';     // 6.1 Объем промышленного производства по отрасли - Горнодобывающая промышленность и разработка карьеров
    public const  IndustrialProductionVolumeIndustryManufacturing         = '93177251-9c7d-43bb-9514-043f48849341';     // 6.2 Объем промышленного производства по отрасли - Обрабатывающая промышленность
    public const  IndustrialProductionVolumeIndustrySupply                = '5e43b73e-b17a-4e9f-8d2b-172fec712beb';     // 6.3 Объем промышленного производства по отрасли - Снабжение электроэнергией, газом, паром, горячей водой и кондиционированным воздухом
    public const  IndustrialProductionVolumeIndustryWaterAndWaste         = '2b0cc221-6a88-4acd-9a0f-722954f2ccc0';     // 6.4 Объем промышленного производства по отрасли - Водоснабжение; сбор, обработка и удаление отходов, деятельность по ликвидации загрязнений
    public const  ManufacturingIndustryOutput                             = 'e41b4609-656e-4baa-bb33-56a3dd6331c1';     // 7 Объем производства обрабатывающей промышленности
    public const  ManufacturingIndustryStructure                          = '2c6da6db-9175-4b7b-9927-bb13acc0e68e';     // 8 Структура производства обрабатывающей промышленности
    public const  ManufacturingIndustryStructureEngineering               = '19acc5e0-3214-4eb9-83ce-463abd21d887';     // 8.1 Структура производства обрабатывающей промышленности - Машиностроение
    public const  ManufacturingIndustryStructureLight                     = 'bf0ab364-e2aa-4658-a75c-7e0330584a22';     // 8.2 Структура производства обрабатывающей промышленности - Легкая промышленность
    public const  ManufacturingIndustryStructureFood                      = '0094e803-7f6f-4fe1-869b-cdf642aa7453';     // 8.3 Структура производства обрабатывающей промышленности - Производство продуктов питания
    public const  ManufacturingIndustryStructureDrink                     = '18d6c172-2dba-47f3-9fb1-fd6a40639b2f';     // 8.4 Структура производства обрабатывающей промышленности - Производство напитков
    public const  ManufacturingIndustryStructureTobacco                   = '14fae168-43e3-4069-9c63-e279f56d4657';     // 8.5 Структура производства обрабатывающей промышленности - Производство табачных изделий
    public const  ManufacturingIndustryStructureWoodAndCork               = '34c85572-3460-4b3a-8493-325e8e2e0057';     // 8.6 Структура производства обрабатывающей промышленности - Производство деревянных и пробковых изделий, кроме мебели; производство изделий из соломки и материалов для плетения
    public const  ManufacturingIndustryStructurePaper                     = '25022b68-af34-4b14-b116-1c736e3a2038';     // 8.7 Структура производства обрабатывающей промышленности - Производство бумаги и бумажной продукции
    public const  ManufacturingIndustryStructurePrintingAndMedia          = '6c4beeb5-6b10-4a7c-bed0-d2c033101fe9';     // 8.8 Структура производства обрабатывающей промышленности - Полиграфическая деятельность и воспроизведение записанных носителей информации
    public const  ManufacturingIndustryStructurePetroleum                 = '9dcf6f1e-4510-4f3c-8426-1532c03f1308';     // 8.9 Структура производства обрабатывающей промышленности - Производство кокса и продуктов нефтепереработки
    public const  ManufacturingIndustryStructureChemical                  = '75681131-0979-4914-93e5-bb66f099afdf';     // 8.10 Структура производства обрабатывающей промышленности - Производство продуктов химической промышленности
    public const  ManufacturingIndustryStructurePharmaceutical            = '1bd09ff5-20ee-4fad-8f4f-f9cad2e252ef';     // 8.11 Структура производства обрабатывающей промышленности - Производство основных фармацевтических продуктов и фармацевтических препаратов
    public const  ManufacturingIndustryStructureRubberAndPlastic          = '92c6fdf3-23aa-4b95-a263-fcfbc0adbe33';     // 8.12 Структура производства обрабатывающей промышленности - Производство резиновых и пластмассовых изделий
    public const  ManufacturingIndustryStructureOtherNonMetal             = '2c710b79-474e-443c-8f7c-85a14e77461f';     // 8.13 Структура производства обрабатывающей промышленности - Производство прочей не металлической минеральной продукции
    public const  ManufacturingIndustryStructureMetallurgical             = '2225e9ae-d930-4427-8c1a-9cfcd3b21100';     // 8.14 Структура производства обрабатывающей промышленности - Металлургическое производство
    public const  ManufacturingIndustryStructureMetalProductsNonMachinery = 'c0d1e15d-c21d-4753-b60b-40e0dfaf4984';     // 8.15 Структура производства обрабатывающей промышленности - Производство готовых металлических изделий, кроме машин и оборудования
    public const  ManufacturingIndustryStructureFurniture                 = 'd692c83f-428f-4c16-a3f0-9dc09f9b8bab';     // 8.16 Структура производства обрабатывающей промышленности - Производство мебели
    public const  ManufacturingIndustryStructureOther                     = 'dd49095d-5406-4026-9b48-599b34c1fb27';     // 8.17 Структура производства обрабатывающей промышленности - Производство прочих готовых изделий
    public const  PhysicalVolumeIndexIndustrialProduction                 = '7bb16c60-b24c-44ca-9640-5ded7da64d23';     // 9 ИФО промышленного производства
    public const  IndustrialProductionByIndustryByYears                   = 'cdbd3721-4e90-452b-b09c-566579271379';     // 10 Объем промышленного производства по отраслям
    public const  PhysicalVolumeIndexManufacturing                        = 'ff9ad2e2-48ad-4d0e-992a-2d9e44492164';     // 11 ИФО обрабатывающей промышленности
    public const  ManufacturingIndustryOutputByYears                      = 'aa964af4-aad8-4369-90a6-61ebae238db5';     // 12 Объем производства обрабатывающей промышленности

    public const MonthRatiosList = [];
    public const QuarterRatiosList = [];

    public const IndustrialProductionVolumeIndustryIds = [
        self::IndustrialProductionVolumeIndustryMining        => 3078703,
        self::IndustrialProductionVolumeIndustryManufacturing => 3078734,
        self::IndustrialProductionVolumeIndustrySupply        => 3079084,
        self::IndustrialProductionVolumeIndustryWaterAndWaste => 3079097,
    ];

    public const IndustrialProductionVolumeIndustryNames = [
        self::IndustrialProductionVolumeIndustryMining        => 'report.Industry.ifo.IndustrialProductionVolumeIndustryMining',
        self::IndustrialProductionVolumeIndustryManufacturing => 'report.Industry.ifo.IndustrialProductionVolumeIndustryManufacturing',
        self::IndustrialProductionVolumeIndustrySupply        => 'report.Industry.ifo.IndustrialProductionVolumeIndustrySupply',
        self::IndustrialProductionVolumeIndustryWaterAndWaste => 'report.Industry.ifo.IndustrialProductionVolumeIndustryWaterAndWaste',
    ];

    public const ManufacturingIndustryStructureIds = [
        self::ManufacturingIndustryStructureEngineering               => 3079122,
        self::ManufacturingIndustryStructureLight                     => 3079124,
        self::ManufacturingIndustryStructureFood                      => 3078735,
        self::ManufacturingIndustryStructureDrink                     => 3078770,
        self::ManufacturingIndustryStructureTobacco                   => 3078779,
        self::ManufacturingIndustryStructureWoodAndCork               => 3078815,
        self::ManufacturingIndustryStructurePaper                     => 3078824,
        self::ManufacturingIndustryStructurePrintingAndMedia          => 19073630,
        self::ManufacturingIndustryStructurePetroleum                 => 3078842,
        self::ManufacturingIndustryStructureChemical                  => 3078847,
        self::ManufacturingIndustryStructurePharmaceutical            => 3078870,
        self::ManufacturingIndustryStructureRubberAndPlastic          => 3078875,
        self::ManufacturingIndustryStructureOtherNonMetal             => 3078884,
        self::ManufacturingIndustryStructureMetallurgical             => 3078917,
        self::ManufacturingIndustryStructureMetalProductsNonMachinery => 3078917,
        self::ManufacturingIndustryStructureFurniture                 => 3079050,
        self::ManufacturingIndustryStructureOther                     => 3079056,
    ];

    public const ManufacturingIndustryStructureNames = [
        self::ManufacturingIndustryStructureEngineering               => 'report.Industry.industries.ManufacturingIndustryStructureEngineering',
        self::ManufacturingIndustryStructureLight                     => 'report.Industry.industries.ManufacturingIndustryStructureLight',
        self::ManufacturingIndustryStructureFood                      => 'report.Industry.industries.ManufacturingIndustryStructureFood',
        self::ManufacturingIndustryStructureDrink                     => 'report.Industry.industries.ManufacturingIndustryStructureDrink',
        self::ManufacturingIndustryStructureTobacco                   => 'report.Industry.industries.ManufacturingIndustryStructureTobacco',
        self::ManufacturingIndustryStructureWoodAndCork               => 'report.Industry.industries.ManufacturingIndustryStructureWoodAndCork',
        self::ManufacturingIndustryStructurePaper                     => 'report.Industry.industries.ManufacturingIndustryStructurePaper',
        self::ManufacturingIndustryStructurePrintingAndMedia          => 'report.Industry.industries.ManufacturingIndustryStructurePrintingAndMedia',
        self::ManufacturingIndustryStructurePetroleum                 => 'report.Industry.industries.ManufacturingIndustryStructurePetroleum',
        self::ManufacturingIndustryStructureChemical                  => 'report.Industry.industries.ManufacturingIndustryStructureChemical',
        self::ManufacturingIndustryStructurePharmaceutical            => 'report.Industry.industries.ManufacturingIndustryStructurePharmaceutical',
        self::ManufacturingIndustryStructureRubberAndPlastic          => 'report.Industry.industries.ManufacturingIndustryStructureRubberAndPlastic',
        self::ManufacturingIndustryStructureOtherNonMetal             => 'report.Industry.industries.ManufacturingIndustryStructureOtherNonMetal',
        self::ManufacturingIndustryStructureMetallurgical             => 'report.Industry.industries.ManufacturingIndustryStructureMetallurgical',
        self::ManufacturingIndustryStructureMetalProductsNonMachinery => 'report.Industry.industries.ManufacturingIndustryStructureMetalProductsNonMachinery',
        self::ManufacturingIndustryStructureFurniture                 => 'report.Industry.industries.ManufacturingIndustryStructureFurniture',
        self::ManufacturingIndustryStructureOther                     => 'report.Industry.industries.ManufacturingIndustryStructureOther',
    ];

    public const VIRTUAL_RATIOS = [
        self::IndustrialProductionVolumeIndustry,
        self::ManufacturingIndustryStructure,
    ];

    public const RatioNames = [
        self::EnterpriseNumber                                        => 'report.Industry.fields.EnterpriseNumber',
        self::Employed                                                => 'report.Industry.fields.Employed',
        self::AverageSalary                                           => 'report.Industry.fields.AverageSalary',
        self::TaxRevenues                                             => 'report.Industry.fields.TaxRevenues',
        self::IndustrialProductionVolume                              => 'report.Industry.fields.IndustrialProductionVolume',
        self::IndustrialProductionVolumeIndustry                      => 'report.Industry.fields.IndustrialProductionVolumeIndustry',
        self::IndustrialProductionVolumeIndustryMining                => 'report.Industry.fields.IndustrialProductionVolumeIndustryMining',
        self::IndustrialProductionVolumeIndustryManufacturing         => 'report.Industry.fields.IndustrialProductionVolumeIndustryManufacturing',
        self::IndustrialProductionVolumeIndustrySupply                => 'report.Industry.fields.IndustrialProductionVolumeIndustrySupply',
        self::IndustrialProductionVolumeIndustryWaterAndWaste         => 'report.Industry.fields.IndustrialProductionVolumeIndustryWaterAndWaste',
        self::ManufacturingIndustryOutput                             => 'report.Industry.fields.ManufacturingIndustryOutput',
        self::ManufacturingIndustryStructure                          => 'report.Industry.fields.ManufacturingIndustryStructure',
        self::ManufacturingIndustryStructureEngineering               => 'report.Industry.fields.ManufacturingIndustryStructureEngineering',
        self::ManufacturingIndustryStructureLight                     => 'report.Industry.fields.ManufacturingIndustryStructureLight',
        self::ManufacturingIndustryStructureFood                      => 'report.Industry.fields.ManufacturingIndustryStructureFood',
        self::ManufacturingIndustryStructureDrink                     => 'report.Industry.fields.ManufacturingIndustryStructureDrink',
        self::ManufacturingIndustryStructureTobacco                   => 'report.Industry.fields.ManufacturingIndustryStructureTobacco',
        self::ManufacturingIndustryStructureWoodAndCork               => 'report.Industry.fields.ManufacturingIndustryStructureWoodAndCork',
        self::ManufacturingIndustryStructurePaper                     => 'report.Industry.fields.ManufacturingIndustryStructurePaper',
        self::ManufacturingIndustryStructurePrintingAndMedia          => 'report.Industry.fields.ManufacturingIndustryStructurePrintingAndMedia',
        self::ManufacturingIndustryStructurePetroleum                 => 'report.Industry.fields.ManufacturingIndustryStructurePetroleum',
        self::ManufacturingIndustryStructureChemical                  => 'report.Industry.fields.ManufacturingIndustryStructureChemical',
        self::ManufacturingIndustryStructurePharmaceutical            => 'report.Industry.fields.ManufacturingIndustryStructurePharmaceutical',
        self::ManufacturingIndustryStructureRubberAndPlastic          => 'report.Industry.fields.ManufacturingIndustryStructureRubberAndPlastic',
        self::ManufacturingIndustryStructureOtherNonMetal             => 'report.Industry.fields.ManufacturingIndustryStructureOtherNonMetal',
        self::ManufacturingIndustryStructureMetallurgical             => 'report.Industry.fields.ManufacturingIndustryStructureMetallurgical',
        self::ManufacturingIndustryStructureMetalProductsNonMachinery => 'report.Industry.fields.ManufacturingIndustryStructureMetalProductsNonMachinery',
        self::ManufacturingIndustryStructureFurniture                 => 'report.Industry.fields.ManufacturingIndustryStructureFurniture',
        self::ManufacturingIndustryStructureOther                     => 'report.Industry.fields.ManufacturingIndustryStructureOther',
        self::PhysicalVolumeIndexIndustrialProduction                 => 'report.Industry.fields.PhysicalVolumeIndexIndustrialProduction',
        self::IndustrialProductionByIndustryByYears                   => 'report.Industry.fields.IndustrialProductionByIndustry',
        self::PhysicalVolumeIndexManufacturing                        => 'report.Industry.fields.PhysicalVolumeIndexManufacturing',
        self::ManufacturingIndustryOutputByYears                      => 'report.Industry.fields.ManufacturingIndustryOutputByYears',
    ];

    public const UrlReportRatios = [
        self::EnterpriseNumber,
        self::Employed,
        self::AverageSalary,
        self::IndustrialProductionVolume,
        self::IndustrialProductionVolumeIndustryMining,
        self::IndustrialProductionVolumeIndustryManufacturing,
        self::IndustrialProductionVolumeIndustrySupply,
        self::IndustrialProductionVolumeIndustryWaterAndWaste,
        self::ManufacturingIndustryOutput,
        self::ManufacturingIndustryStructureEngineering,
        self::ManufacturingIndustryStructureLight,
        self::ManufacturingIndustryStructureFood,
        self::ManufacturingIndustryStructureDrink,
        self::ManufacturingIndustryStructureTobacco,
        self::ManufacturingIndustryStructureWoodAndCork,
        self::ManufacturingIndustryStructurePaper,
        self::ManufacturingIndustryStructurePrintingAndMedia,
        self::ManufacturingIndustryStructurePetroleum,
        self::ManufacturingIndustryStructureChemical,
        self::ManufacturingIndustryStructurePharmaceutical,
        self::ManufacturingIndustryStructureRubberAndPlastic,
        self::ManufacturingIndustryStructureOtherNonMetal,
        self::ManufacturingIndustryStructureMetallurgical,
        self::ManufacturingIndustryStructureMetalProductsNonMachinery,
        self::ManufacturingIndustryStructureFurniture,
        self::ManufacturingIndustryStructureOther,
        self::PhysicalVolumeIndexIndustrialProduction,
        self::PhysicalVolumeIndexManufacturing,
    ];

    public const PlainRatios = [
        self::EnterpriseNumber                        => 'enterpriseNumber',
        self::TaxRevenues                             => 'tax',
        self::ManufacturingIndustryOutput             => 'manufacturingIndustryOutput',
        self::IndustrialProductionVolume              => 'industrialProductionVolume',
        self::PhysicalVolumeIndexIndustrialProduction => 'physicalVolumeIndexIndustrialProduction',
        self::PhysicalVolumeIndexManufacturing        => 'physicalVolumeIndexManufacturing',
    ];

    public const QuarterRatios = [
        self::Employed                                => 'employedCount',
        self::AverageSalary                           => 'averageSalary',
    ];

}

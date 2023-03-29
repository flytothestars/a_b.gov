<?php

namespace App\Repositories\Enums\Reports\Ser;

interface ITradeRatioReport
{
    public const  EnterpriseNumber                  = 'a5dacd46-35fe-4080-ab5e-0c185be44a1f';     // 1 Количество предприятий
    public const  Employed                          = 'd92bf5e5-65a5-4bb6-983c-b3f501f7c129';     // 2 Численность занятых
    public const  AverageSalary                     = '15a48f27-6019-48c9-8178-a547192c7840';     // 3 Средняя зарплата
    public const  TaxRevenues                       = '699bbcbc-d414-4abe-852b-4671008498c9';     // 4 Налоговые поступления
    public const  TradeWholesaleTurnover            = '34e44b2e-ac24-4fb3-b0cf-bf00558a279c';     // 5 Товарооборот оптовой торговли
    public const  TradeWholesaleStructure           = 'aabbbe84-e8dc-48f0-a42e-c00472d0befb';     // 6 Структура оптовой торговли по видам товаров
    public const  TradeWholesaleStructureFood       = 'ea5d24fc-18fc-47ed-9ef4-6aed7622d564';     // 6.1 Товарооборот оптовой торговли - Продовольственные товары
    public const  TradeWholesaleStructureNonFood    = '629123c7-40f8-4224-9d6e-e9bef922a568';     // 6.2 Товарооборот оптовой торговли - Непродовольственные товары
    public const  TradeWholesalePhysicalVolumeIndex = '6cd16adc-8934-4a6e-a1f6-682b8c11b765';     // 7 ИФО оптовой торговли
    public const  TradeWholesaleTurnoverByYears     = 'f242e867-67e1-4dcf-8f1a-f57f8ba64ac3';     // 8 Динамика оборотов оптовой торговли
    public const  TradeWholesaleTurnoverByDistrict  = 'f417931b-9666-4786-9ede-07f31d1bd470';     // 9 Товарооборот оптовой торговли по районам
    public const  TradeRetailTurnover               = '8b0cfb3e-a48a-44ae-a6f0-238a439f66bd';     // 10 Товарооборот розничной торговли
    public const  TradeRetailStructure              = '3b4ad29d-a99c-4227-b693-e6ad0d36522f';     // 11 Структура розничной торговли по видам товаров
    public const  TradeRetailStructureFood          = '1817b119-bedd-49fa-b84f-f0719cc824fb';     // 11.1 Структура розничной торговли - Продовольственные товары
    public const  TradeRetailStructureNonFood       = '90d1669c-2458-4ce3-a46d-d4fedfc28d2c';     // 11.2 Структура розничной торговли - Непродовольственные товары
    public const  TradeRetailPhysicalVolumeIndex    = '30371cab-69cf-4be8-ad71-12f726aaaa82';     // 12 ИФО розничной торговли
    public const  TradeRetailTurnoverByYears        = '6a2ed59a-b72b-48e7-bf32-be6eb97166af';     // 13 Динамика оборотов розничной торговли
    public const  TradeRetailTurnoverByDistrict     = 'fc89db34-1e79-4dd8-b150-56810ec8ec9d';     // 14 Товарооборот розничной торговли по районам

    public const MonthRatiosList = [];
    public const QuarterRatiosList = [];

    public const VIRTUAL_RATIOS = [
        self::TradeWholesaleStructure,
        self::TradeRetailStructure,
    ];

    public const TradeStructureNames = [
        self::TradeWholesaleStructureFood    => 'report.Trade.structure.food',
        self::TradeWholesaleStructureNonFood => 'report.Trade.structure.nonFood',
        self::TradeRetailStructureFood       => 'report.Trade.structure.food',
        self::TradeRetailStructureNonFood    => 'report.Trade.structure.nonFood',
    ];

    public const TradeWholesaleStructureIds = [
        self::TradeWholesaleStructureFood    => 452411,
        self::TradeWholesaleStructureNonFood => 452412,
    ];

    public const TradeRetailStructureIds = [
        self::TradeRetailStructureFood    => 452411,
        self::TradeRetailStructureNonFood => 452412,
    ];

    public const CITY_REPORT_RATIOS = [
        self::EnterpriseNumber,
        self::Employed,
        self::AverageSalary,
        self::TaxRevenues,
        self::TradeWholesaleTurnover,
        self::TradeWholesaleStructureFood,
        self::TradeWholesaleStructureNonFood,
        self::TradeWholesalePhysicalVolumeIndex,
        self::TradeWholesaleTurnoverByYears,
        self::TradeRetailTurnoverByYears,
        self::TradeRetailTurnover,
        self::TradeRetailStructureFood,
        self::TradeRetailStructureNonFood,
        self::TradeRetailPhysicalVolumeIndex,
    ];

    public const DISTRICT_REPORT_RATIOS = [
        self::TradeWholesaleTurnoverByDistrict,
        self::TradeRetailTurnoverByDistrict,
    ];

    public const PlainRatios = [
        self::EnterpriseNumber                  => 'enterpriseNumber',
        self::TaxRevenues                       => 'tax',
        self::TradeWholesaleTurnover            => 'tradeWholesaleTurnover',
        self::TradeWholesalePhysicalVolumeIndex => 'tradeWholesalePhysicalVolumeIndex',
        self::TradeRetailTurnover               => 'tradeRetailTurnover',
        self::TradeRetailPhysicalVolumeIndex    => 'tradeRetailPhysicalVolumeIndex',
    ];


    public const QuarterRatios = [
        self::Employed                          => 'employedCount',
        self::AverageSalary                     => 'averageSalary',
    ];

    public const RatioNames = [
        self::EnterpriseNumber                  => 'report.Trade.fields.EnterpriseNumber',
        self::Employed                          => 'report.Trade.fields.Employed',
        self::AverageSalary                     => 'report.Trade.fields.AverageSalary',
        self::TaxRevenues                       => 'report.Trade.fields.TaxRevenues',
        self::TradeWholesaleTurnover            => 'report.Trade.fields.TradeWholesaleTurnover',
        self::TradeWholesaleStructure           => 'report.Trade.fields.TradeWholesaleStructure',
        self::TradeWholesaleStructureFood       => 'report.Trade.fields.TradeWholesaleStructureFood',
        self::TradeWholesaleStructureNonFood    => 'report.Trade.fields.TradeWholesaleStructureNonFood',
        self::TradeWholesalePhysicalVolumeIndex => 'report.Trade.fields.TradeWholesalePhysicalVolumeIndex',
        self::TradeWholesaleTurnoverByYears     => 'report.Trade.fields.TradeWholesaleTurnoverByYears',
        self::TradeWholesaleTurnoverByDistrict  => 'report.Trade.fields.TradeWholesaleTurnoverByDistrict',
        self::TradeRetailTurnover               => 'report.Trade.fields.TradeRetailTurnover',
        self::TradeRetailStructure              => 'report.Trade.fields.TradeRetailStructure',
        self::TradeRetailStructureFood          => 'report.Trade.fields.TradeRetailStructureFood',
        self::TradeRetailStructureNonFood       => 'report.Trade.fields.TradeRetailStructureNonFood',
        self::TradeRetailPhysicalVolumeIndex    => 'report.Trade.fields.TradeRetailPhysicalVolumeIndex',
        self::TradeRetailTurnoverByYears        => 'report.Trade.fields.TradeRetailTurnoverByYears',
        self::TradeRetailTurnoverByDistrict     => 'report.Trade.fields.TradeRetailTurnoverByDistrict',
    ];

}

<?php

namespace App\Repositories\Enums\Reports;

interface ITradeReportRatioEnum
{

    public const ForecastAmount                                     = '6bee568c-d5ce-441e-8ced-df2e50eaa6b0';
    public const ForecastPhysicalVolumeIndex                        = '4b2a304c-9ce3-490a-99f7-de1d8ad6c19f';
    public const PhysicalVolumeIndexMonthByYears                    = 'e9b980f1-aa72-45f2-bb3e-549691912408';
    public const TradingLastMonthAmountByYears                      = '6a7f614d-ec29-40e2-89a8-ffb5eb81d77b';
    public const TradingByPeriods                                   = '5a5f9fc5-36e0-45d9-988d-b134c0559388';
    public const RetailTradingPhysicalVolumeIndexFoodTotal          = '5ace0e91-0e60-4083-a71a-934870cb7f1e';
    public const RetailTradingPhysicalVolumeIndexNonFoodTotal       = 'e6983525-2532-4f61-8550-7e816db595c2';
    public const WholesaleTradingPhysicalVolumeIndexFoodTotal       = '7bc986ed-d95d-46cc-9d34-63ceb01c9811';
    public const WholesaleTradingPhysicalVolumeIndexNonFoodTotal    = 'abffe93f-5175-4df4-9157-3821b68f60c8';
    public const PhysicalVolumeIndexCommonPercentRetail             = 'e11b0c16-8afc-48e0-b981-de331950943d';
    public const PhysicalVolumeIndexCommonAmountRetail              = '1fb79cbe-c7d0-4279-845e-fdb7f092e3e6';
    public const PhysicalVolumeIndexCommonPercentWholesale          = '4e2290fc-c6ee-4d0b-b9a3-2fa942fddf03';
    public const PhysicalVolumeIndexCommonAmountWholesale           = '5619c728-07cc-4263-863c-8b6e70638172';
    public const PhysicalVolumeIndexProductAmountRetail             = '13d8437f-dea6-4783-8412-d064c86ea343';
    public const PhysicalVolumeIndexProductAmountWholesale          = '92ff242a-9d20-4a80-a89d-dcf4fcd9763e';
    public const PhysicalVolumeIndexNoProductAmountRetail           = 'a69fe2b6-cba0-4960-a972-0dbd54c3d052';
    public const PhysicalVolumeIndexNoProductAmountWholesale        = '631e13ff-48f2-4f8c-89ab-cd6c7241ceed';
    public const PhysicalVolumeIndexProductPercentRetail            = '0eefbaf8-ad24-4b33-8dd4-5c1b52b1cd95';
    public const PhysicalVolumeIndexProductPercentWholesale         = 'ac90d2d2-5724-4122-9a43-551be251979f';
    public const PhysicalVolumeIndexNoProductPercentRetail          = '7cbda6e3-5c28-4f98-9862-bbf82d4c391a';
    public const PhysicalVolumeIndexNoProductPercentWholesale       = '3501f5a7-48b4-4a6d-9113-d677c1052077';
    public const PhysicalVolumeIndexProductAmountRetailQuarter      = 'fee320ec-4825-458d-9316-1c1c79f9d9b3';
    public const PhysicalVolumeIndexProductAmountWholesaleQuarter   = '906fbe0b-7b2b-470e-9734-ea249369b224';
    public const PhysicalVolumeIndexNoProductAmountRetailQuarter    = '59193a03-9886-43e4-b6e2-729af2af5abe';
    public const PhysicalVolumeIndexNoProductAmountWholesaleQuarter = '1e316503-53ee-48ba-aaa9-3c614c3c21a2';

    public const PhysicalVolumeIndexCommonPercentRetailName       = 'report.Trade.PhysicalVolumeIndexCommonPercentRetailName';
    public const PhysicalVolumeIndexCommonAmountRetailName        = 'report.Trade.PhysicalVolumeIndexCommonAmountRetailName';
    public const PhysicalVolumeIndexCommonPercentWholesaleName    = 'report.Trade.PhysicalVolumeIndexCommonPercentWholesaleName';
    public const PhysicalVolumeIndexCommonAmountWholesaleName     = 'report.Trade.PhysicalVolumeIndexCommonAmountWholesaleName';
    public const PhysicalVolumeIndexProductAmountRetailName       = 'report.Trade.PhysicalVolumeIndexProductAmountRetailName';
    public const PhysicalVolumeIndexProductAmountWholesaleName    = 'report.Trade.PhysicalVolumeIndexProductAmountWholesaleName';
    public const PhysicalVolumeIndexNoProductAmountRetailName     = 'report.Trade.PhysicalVolumeIndexNoProductAmountRetailName';
    public const PhysicalVolumeIndexNoProductAmountWholesaleName  = 'report.Trade.PhysicalVolumeIndexNoProductAmountWholesaleName';
    public const PhysicalVolumeIndexProductPercentRetailName      = 'report.Trade.PhysicalVolumeIndexProductPercentRetailName';
    public const PhysicalVolumeIndexProductPercentWholesaleName   = 'report.Trade.PhysicalVolumeIndexProductPercentWholesaleName';
    public const PhysicalVolumeIndexNoProductPercentRetailName    = 'report.Trade.PhysicalVolumeIndexNoProductPercentRetailName';
    public const PhysicalVolumeIndexNoProductPercentWholesaleName = 'report.Trade.PhysicalVolumeIndexNoProductPercentWholesaleName';

    public const PercentRatios = [
        self::PhysicalVolumeIndexCommonPercentRetail,
        self::PhysicalVolumeIndexCommonPercentWholesale,
        self::PhysicalVolumeIndexProductPercentRetail,
        self::PhysicalVolumeIndexProductPercentWholesale,
        self::PhysicalVolumeIndexNoProductPercentRetail,
        self::PhysicalVolumeIndexNoProductPercentWholesale,
    ];
    public const AmountRatios  = [
        self::PhysicalVolumeIndexCommonAmountRetail,
        self::PhysicalVolumeIndexCommonAmountWholesale,
        self::PhysicalVolumeIndexProductAmountRetail,
        self::PhysicalVolumeIndexProductAmountWholesale,
        self::PhysicalVolumeIndexNoProductAmountRetail,
        self::PhysicalVolumeIndexNoProductAmountWholesale,
    ];


    public const CITY_RATIOS_LIST = [
        self::PhysicalVolumeIndexCommonPercentRetail,
        self::PhysicalVolumeIndexCommonAmountRetail,
        self::PhysicalVolumeIndexCommonPercentWholesale,
        self::PhysicalVolumeIndexCommonAmountWholesale,
        self::PhysicalVolumeIndexProductAmountRetail,
        self::PhysicalVolumeIndexProductAmountWholesale,
        self::PhysicalVolumeIndexNoProductAmountRetail,
        self::PhysicalVolumeIndexNoProductAmountWholesale,
        self::PhysicalVolumeIndexProductPercentRetail,
        self::PhysicalVolumeIndexProductPercentWholesale,
        self::PhysicalVolumeIndexNoProductPercentRetail,
        self::PhysicalVolumeIndexNoProductPercentWholesale,
    ];

    public const VirtualRatioList = [
        self::ForecastAmount,
        self::ForecastPhysicalVolumeIndex,
        self::PhysicalVolumeIndexMonthByYears,
        self::TradingLastMonthAmountByYears,
        self::TradingByPeriods,
        self::RetailTradingPhysicalVolumeIndexFoodTotal,
        self::WholesaleTradingPhysicalVolumeIndexFoodTotal,
        self::WholesaleTradingPhysicalVolumeIndexNonFoodTotal,
        self::PhysicalVolumeIndexProductAmountRetailQuarter,
        self::PhysicalVolumeIndexProductAmountWholesaleQuarter,
        self::PhysicalVolumeIndexNoProductAmountRetailQuarter,
        self::PhysicalVolumeIndexNoProductAmountWholesaleQuarter,
    ];

    public const CalculatedRatioList = [
        self::ForecastAmount,
        self::ForecastPhysicalVolumeIndex,
        self::RetailTradingPhysicalVolumeIndexFoodTotal,
        self::RetailTradingPhysicalVolumeIndexNonFoodTotal,
        self::WholesaleTradingPhysicalVolumeIndexFoodTotal,
        self::WholesaleTradingPhysicalVolumeIndexNonFoodTotal,
        self::PhysicalVolumeIndexProductAmountRetailQuarter,
        self::PhysicalVolumeIndexProductAmountWholesaleQuarter,
        self::PhysicalVolumeIndexNoProductAmountRetailQuarter,
        self::PhysicalVolumeIndexNoProductAmountWholesaleQuarter,
    ];

    public const RatioNames = [
        self::PhysicalVolumeIndexCommonPercentRetail       => self::PhysicalVolumeIndexCommonPercentRetailName,
        self::PhysicalVolumeIndexCommonAmountRetail        => self::PhysicalVolumeIndexCommonAmountRetailName,
        self::PhysicalVolumeIndexCommonPercentWholesale    => self::PhysicalVolumeIndexCommonPercentWholesaleName,
        self::PhysicalVolumeIndexCommonAmountWholesale     => self::PhysicalVolumeIndexCommonAmountWholesaleName,
        self::PhysicalVolumeIndexProductAmountRetail       => self::PhysicalVolumeIndexProductAmountRetailName,
        self::PhysicalVolumeIndexProductAmountWholesale    => self::PhysicalVolumeIndexProductAmountWholesaleName,
        self::PhysicalVolumeIndexNoProductAmountRetail     => self::PhysicalVolumeIndexNoProductAmountRetailName,
        self::PhysicalVolumeIndexNoProductAmountWholesale  => self::PhysicalVolumeIndexNoProductAmountWholesaleName,
        self::PhysicalVolumeIndexProductPercentRetail      => self::PhysicalVolumeIndexProductPercentRetailName,
        self::PhysicalVolumeIndexProductPercentWholesale   => self::PhysicalVolumeIndexProductPercentWholesaleName,
        self::PhysicalVolumeIndexNoProductPercentRetail    => self::PhysicalVolumeIndexNoProductPercentRetailName,
        self::PhysicalVolumeIndexNoProductPercentWholesale => self::PhysicalVolumeIndexNoProductPercentWholesaleName,
    ];

    public const OldRatios = [
        self:: ForecastAmount,
        self:: ForecastPhysicalVolumeIndex,
        self:: PhysicalVolumeIndexMonthByYears,
        self:: TradingLastMonthAmountByYears,
        self:: TradingByPeriods,
        self:: RetailTradingPhysicalVolumeIndexFoodTotal,
        self:: RetailTradingPhysicalVolumeIndexNonFoodTotal,
        self:: WholesaleTradingPhysicalVolumeIndexFoodTotal,
        self:: WholesaleTradingPhysicalVolumeIndexNonFoodTotal,
        self:: PhysicalVolumeIndexCommonPercentRetail,
        self:: PhysicalVolumeIndexCommonAmountRetail,
        self:: PhysicalVolumeIndexCommonPercentWholesale,
        self:: PhysicalVolumeIndexCommonAmountWholesale,
        self:: PhysicalVolumeIndexProductAmountRetail,
        self:: PhysicalVolumeIndexProductAmountWholesale,
        self:: PhysicalVolumeIndexNoProductAmountRetail,
        self:: PhysicalVolumeIndexNoProductAmountWholesale,
        self:: PhysicalVolumeIndexProductPercentRetail,
        self:: PhysicalVolumeIndexProductPercentWholesale,
        self:: PhysicalVolumeIndexNoProductPercentRetail,
        self:: PhysicalVolumeIndexNoProductPercentWholesale,
        self:: PhysicalVolumeIndexProductAmountRetailQuarter,
        self:: PhysicalVolumeIndexProductAmountWholesaleQuarter,
        self:: PhysicalVolumeIndexNoProductAmountRetailQuarter,
        self:: PhysicalVolumeIndexNoProductAmountWholesaleQuarter,
    ];

}

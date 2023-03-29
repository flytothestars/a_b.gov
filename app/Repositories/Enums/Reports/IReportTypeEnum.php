<?php

namespace App\Repositories\Enums\Reports;

use App\Repositories\Enums\Reports\Prt\IPrtReport;
use App\Repositories\Enums\Reports\Ser\IBusinessStatisticsRatioEnum;
use App\Repositories\Enums\Reports\Ser\IIndustryRatioReport;
use App\Repositories\Enums\Reports\Ser\IInvestmentReport;
use App\Repositories\Enums\Reports\Ser\ITradeRatioReport;

interface IReportTypeEnum
{
    public const ReportTypeIndustry       = 1;
    public const ReportTypeTrade          = 2;
    public const ReportBusinessStatistics = 3;
    public const ReportTypeInvestments    = 4;
    public const ReportTypePTR            = 5;

    public const ReportTypeList = [
        self::ReportTypeIndustry,
        self::ReportTypeTrade,
        self::ReportBusinessStatistics,
        self::ReportTypeInvestments,
        self::ReportTypePTR,
    ];

    public const ReportContractsList = [
        self::ReportTypeIndustry       => IIndustryRatioReport::class,
        self::ReportTypeTrade          => ITradeRatioReport::class,
        self::ReportBusinessStatistics => IBusinessStatisticsRatioEnum::class,
        self::ReportTypeInvestments    => IInvestmentReport::class,
        self::ReportTypePTR            => IPrtReport::class,
    ];

}

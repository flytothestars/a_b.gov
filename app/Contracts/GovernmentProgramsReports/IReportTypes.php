<?php

namespace App\Contracts\GovernmentProgramsReports;

use App\Imports\AlmatyFinanceImport;
use App\Imports\BusinessMFOImport;
use App\Imports\DKBGuaranteeImport;
use App\Imports\DKBSubsidiesImport;
use App\Imports\DKBSubsidiesSimpleThingImport;
use App\Imports\EnbekImport;
use App\Imports\ZhibekZholyImport;
use App\Repositories\GovernmentProgramsReports\IGovernmentAlmatyFinanceReportsRepositoryContract;
use App\Repositories\GovernmentProgramsReports\IGovernmentEnbekReportsRepositoryContract;
use App\Repositories\GovernmentProgramsReports\IGovernmentGuaranteeReportsRepositoryContract;
use App\Repositories\GovernmentProgramsReports\IGovernmentMFOReportsRepositoryContract;
use App\Repositories\GovernmentProgramsReports\IGovernmentQoldayReportsRepositoryContract;
use App\Repositories\GovernmentProgramsReports\IGovernmentSubsidiesReportsRepositoryContract;
use App\Repositories\GovernmentProgramsReports\IGovernmentSubsidiesSimpleThingsReportsRepositoryContract;
use App\Repositories\GovernmentProgramsReports\IGovernmentZhibekZholyReportsRepositoryContract;

interface IReportTypes
{
    public const TypeDKBGuarantee              = 1;     // Госпрограммы. Гарантирование ДКБ 2025
    public const TypeDKBSubsidies              = 2;     // Госпрограммы. Субсидирование ДКБ 2025
    public const TypeDKBSubsidiesSimpleThings  = 3;     // Госпрограммы. Субсидирование ДКБ 2025 – ЭКОНОМИКА ПРОСТЫХ ВЕЩЕЙ
    public const TypeAlmatyBusinessZhibekZholy = 4;     // Almaty Business. Жибек жолы
    public const TypeEnbek                     = 5;     // Госпрограммы. Енбек
    public const TypeAlmatyFinance             = 6;     // Алматы Бизнес Almaty Finance
    public const TypeAlmatyBusinessMFO         = 7;     // Алматы Бизнес МФО
    public const TypeQolday                    = 8;     // Qolday

    public const ReportTypesList = [
        self::TypeDKBGuarantee,
        self::TypeDKBSubsidies,
        self::TypeDKBSubsidiesSimpleThings,
        self::TypeAlmatyBusinessZhibekZholy,
        self::TypeEnbek,
        self::TypeAlmatyFinance,
        self::TypeAlmatyBusinessMFO,
        self::TypeQolday,
    ];

    public const ReportTypesNames = [
        self::TypeDKBGuarantee              => 'messages.reports.government.TypeDKBGuarantee',
        self::TypeDKBSubsidies              => 'messages.reports.government.TypeDKBSubsidies',
        self::TypeDKBSubsidiesSimpleThings  => 'messages.reports.government.TypeDKBSubsidiesSimpleThings',
        self::TypeAlmatyBusinessZhibekZholy => 'messages.reports.government.TypeAlmatyBusinessZhibekZholy',
        self::TypeEnbek                     => 'messages.reports.government.TypeEnbek',
        self::TypeAlmatyFinance             => 'messages.reports.government.TypeAlmatyFinance',
        self::TypeAlmatyBusinessMFO         => 'messages.reports.government.TypeAlmatyBusinessMFO',
        self::TypeQolday                    => 'messages.reports.government.TypeQolday',
    ];

    public const ReportRepositoryList = [
        self::TypeDKBGuarantee              => IGovernmentGuaranteeReportsRepositoryContract::class,
        self::TypeDKBSubsidies              => IGovernmentSubsidiesReportsRepositoryContract::class,
        self::TypeDKBSubsidiesSimpleThings  => IGovernmentSubsidiesSimpleThingsReportsRepositoryContract::class,
        self::TypeAlmatyBusinessZhibekZholy => IGovernmentZhibekZholyReportsRepositoryContract::class,
        self::TypeEnbek                     => IGovernmentEnbekReportsRepositoryContract::class,
        self::TypeAlmatyFinance             => IGovernmentAlmatyFinanceReportsRepositoryContract::class,
        self::TypeAlmatyBusinessMFO         => IGovernmentMFOReportsRepositoryContract::class,
        self::TypeQolday                    => IGovernmentQoldayReportsRepositoryContract::class,
    ];

    public const ReportContractList = [
        self::TypeDKBGuarantee              => IReportDKBGuarantee::class,
        self::TypeDKBSubsidies              => IReportDKBSubsidies::class,
        self::TypeDKBSubsidiesSimpleThings  => IReportDKBSubsidiesSimpleThings::class,
        self::TypeAlmatyBusinessZhibekZholy => IReportAlmatyBusinessZhibekZholy::class,
        self::TypeEnbek                     => IReportEnbek::class,
        self::TypeAlmatyFinance             => IReportTypeAlmatyFinance::class,
        self::TypeAlmatyBusinessMFO         => IReportAlmatyBusinessMFO::class,
        self::TypeQolday                    => IReportQolday::class,
    ];

    public const ReportImportsList = [
        self::TypeDKBGuarantee              => DKBGuaranteeImport::class,
        self::TypeDKBSubsidies              => DKBSubsidiesImport::class,
        self::TypeDKBSubsidiesSimpleThings  => DKBSubsidiesSimpleThingImport::class,
        self::TypeAlmatyBusinessZhibekZholy => ZhibekZholyImport::class,
        self::TypeEnbek                     => EnbekImport::class,
        self::TypeAlmatyFinance             => AlmatyFinanceImport::class,
        self::TypeAlmatyBusinessMFO         => BusinessMFOImport::class,
    ];


}

<?php

namespace App\Contracts\GovernmentProgramsReports;

interface IReportStatuses
{
    public const New           = 1;
    public const InvalidFile   = 2;
    public const ImportStarted = 3;
    public const ImportFailed  = 4;
    public const Finished      = 5;

    public const StatusList = [
        self::New,
        self::InvalidFile,
        self::ImportStarted,
        self::ImportFailed,
        self::Finished,
    ];

    public const StatusNamesList = [
        self::New           => 'messages.reports.government.statuses.New',
        self::InvalidFile   => 'messages.reports.government.statuses.InvalidFile',
        self::ImportStarted => 'messages.reports.government.statuses.ImportStarted',
        self::ImportFailed  => 'messages.reports.government.statuses.ImportFailed',
        self::Finished      => 'messages.reports.government.statuses.Finished',
    ];

}

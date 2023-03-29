<?php

namespace App\Integration;

interface IMioBusinessStatuses
{
    public const ACCEPTED                = 'ACCEPTED';
    public const UPDATE_REQUIRED         = 'UPDATE_REQUIRED';
    public const ACCEPTED_BY_CALL_CENTER = 'ACCEPTED_BY_CALL_CENTER';
    public const REJECTED_BY_CALL_CENTER = 'REJECTED_BY_CALL_CENTER';
    public const NEEDS_UPDATE            = 'NEEDS_UPDATE';
    public const PENDING                 = 'PENDING';
    public const AVAILABLE               = 'AVAILABLE';
    public const CLOSED                  = 'CLOSED';

    public const StatusList = [
        self::ACCEPTED,
        self::UPDATE_REQUIRED,
        self::ACCEPTED_BY_CALL_CENTER,
        self::REJECTED_BY_CALL_CENTER,
        self::NEEDS_UPDATE,
        self::PENDING,
        self::AVAILABLE,
        self::CLOSED,
    ];

    public const StatusListNames = [
        self::ACCEPTED                => 'messages.mio.statuses.ACCEPTED',
        self::UPDATE_REQUIRED         => 'messages.mio.statuses.UPDATE_REQUIRED',
        self::ACCEPTED_BY_CALL_CENTER => 'messages.mio.statuses.ACCEPTED_BY_CALL_CENTER',
        self::REJECTED_BY_CALL_CENTER => 'messages.mio.statuses.REJECTED_BY_CALL_CENTER',
        self::NEEDS_UPDATE            => 'messages.mio.statuses.NEEDS_UPDATE',
        self::PENDING                 => 'messages.mio.statuses.PENDING',
        self::AVAILABLE               => 'messages.mio.statuses.AVAILABLE',
        self::CLOSED                  => 'messages.mio.statuses.CLOSED',
    ];


}

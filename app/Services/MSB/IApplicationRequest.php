<?php

namespace App\Services\MSB;

use Illuminate\Contracts\Support\Arrayable;

interface IApplicationRequest extends Arrayable
{
    public const ApplicationKey            = 'key';
    public const ApplicationBinIin         = 'bin';
    public const ApplicationProgramId      = 'program_id';
    public const ApplicationProgramType    = 'program_type';
    public const ApplicationClientName     = 'name';
    public const ApplicationClientPhone    = 'phone';
    public const ApplicationClientAmount   = 'amount';
    public const ApplicationClientTurnover = 'turnover';
    public const ApplicationBanksIds       = 'banks';

    public const ApplicationFields = [
        self::ApplicationKey,
        self::ApplicationBanksIds,
        self::ApplicationBinIin,
        self::ApplicationProgramId,
        self::ApplicationProgramType,
        self::ApplicationClientName,
        self::ApplicationClientPhone,
        self::ApplicationClientAmount,
        self::ApplicationClientTurnover,
    ];

    public function setKey(string $key): void;

}

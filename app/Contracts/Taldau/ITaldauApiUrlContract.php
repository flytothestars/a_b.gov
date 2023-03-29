<?php

namespace App\Contracts\Taldau;

interface ITaldauApiUrlContract
{

    public const FIELD_ID              = 'id';
    public const FIELD_IS_ACTIVE       = 'is_active';
    public const FIELD_URL             = 'url';
    public const FIELD_REPORT_TYPE_ID  = 'report_type_id';
    public const FIELD_REPORT_RATIO_ID = 'report_ratio_id';
    public const CreatedAt             = 'created_at';
    public const UpdatedAt             = 'updated_at';

    public const FillableFieldList = [
        self::FIELD_ID,
        self::FIELD_IS_ACTIVE,
        self::FIELD_URL,
        self::FIELD_REPORT_TYPE_ID,
        self::FIELD_REPORT_RATIO_ID,
        self::CreatedAt,
        self::UpdatedAt,
    ];

}

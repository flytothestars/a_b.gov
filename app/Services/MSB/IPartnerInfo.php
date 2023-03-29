<?php

namespace App\Services\MSB;

use Illuminate\Contracts\Support\Arrayable;

interface IPartnerInfo extends Arrayable
{
    public const FieldId              = 'id';
    public const FieldPartnerId       = 'partner.id';
    public const FieldPartnerName     = 'partner.name';
    public const FieldPartnerLogo     = 'partner.logo';
    public const FieldPartnerIsHidden = 'partner.is_hidden';
    public const FieldPartnerOrder    = 'partner.order';

    public const FieldList = [
        self::FieldId,
        self::FieldPartnerId,
        self::FieldPartnerName,
        self::FieldPartnerLogo,
        self::FieldPartnerIsHidden,
        self::FieldPartnerOrder,
    ];

    public function getPartnerProgramId(): ?int;

    public function getPartnerId(): ?int;

    public function getPartnerName(): string;

    public function getPartnerLogo(): string;


}

<?php

namespace App\Services\MSB;

use Illuminate\Support\Arr;

class PartnerInfo implements IPartnerInfo
{
    private array $items;

    /**
     * PartnerInfo constructor.
     *
     * @param array $items
     */
    public function __construct(array $items)
    {
        foreach (self::FieldList as $field) {
            if (Arr::has($items, $field)) {
                $this->items[ $field ] = Arr::get($items, $field);
            }
        }
    }

    final public function toArray(): array
    {
        return $this->items;
    }

    final public function getPartnerProgramId(): ?int
    {
        return $this->items[ self::FieldId ];
    }

    final public function getPartnerId(): ?int
    {
        return $this->items[ self::FieldPartnerId ];
    }

    final public function getPartnerName(): string
    {
        return $this->items[ self::FieldPartnerName ];
    }

    final public function getPartnerLogo(): string
    {
        $baseUrl = config('app.import.msb.media');
        if (
        isset($this->items[ self::FieldPartnerLogo ])
        ) {
            $logo = $this->items[ self::FieldPartnerLogo ];
            return "$baseUrl/$logo";
        }
        return '';
    }
}

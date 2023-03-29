<?php

namespace App\Services\MSB;

class ProgramInfo implements IProgramInfo
{
    private array $items;

    /**
     * ProgramInfo constructor.
     *
     * @param array $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    final public function toArray(): array
    {
        return $this->items;
    }

    final public function getOwnerLogoUrl(): string
    {
        $baseUrl = config('app.import.msb.media');
        if (
            isset($this->items[ self::ProgramOwner ])
            && is_array($this->items[ self::ProgramOwner ])
            && array_key_exists('logo', $this->items[ self::ProgramOwner ])
        ) {
            $logo = $this->items[ self::ProgramOwner ][ 'logo' ];
            return "$baseUrl/$logo";
        }
        return '';
    }

    final public function getOwnerName(): string
    {
        if (
            isset($this->items[ self::ProgramOwner ])
            && is_array($this->items[ self::ProgramOwner ])
            && array_key_exists('name', $this->items[ self::ProgramOwner ])
        ) {
            return $this->items[ self::ProgramOwner ][ 'name' ];
        }
        return '';
    }

    final public function getOwnerId(): int
    {
        if (
            isset($this->items[ self::ProgramOwner ])
            && is_array($this->items[ self::ProgramOwner ])
            && array_key_exists('id', $this->items[ self::ProgramOwner ])
        ) {
            return $this->items[ self::ProgramOwner ][ 'id' ];
        }
        return '';
    }

    final public function getProgramType(): string
    {
        return $this->items[ self::ProgramType ] ?? '';
    }

    final public function getProgramId(): ?int
    {
        return $this->items[ self::ProgramId ] ?? null;
    }

    final public function getPartners(): array
    {
        $partners = [];
        $partnersList = collect($this->items[ self::ProgramPartners ]);
        $partnersList = $partnersList->sortBy('partner.order')->toArray();
        foreach ($partnersList as $partner) {
            $partners[] = new PartnerInfo($partner);
        }
        return $partners;
    }

}

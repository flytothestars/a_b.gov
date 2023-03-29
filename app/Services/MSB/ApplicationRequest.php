<?php

namespace App\Services\MSB;

class ApplicationRequest implements IApplicationRequest
{
    private array $items;

    /**
     * ApplicationRequest constructor.
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

    final public function setKey(string $key): void
    {
        $this->items[ self::ApplicationKey ] = $key;
    }


}

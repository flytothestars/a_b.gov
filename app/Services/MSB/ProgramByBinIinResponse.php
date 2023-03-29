<?php

namespace App\Services\MSB;

use Illuminate\Support\Arr;

class ProgramByBinIinResponse implements IProgramByBinIinResponse
{

    private array $items;

    /**
     * ProgramByBinIinResponse constructor.
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

    final public function getCommonInformationData(): array
    {
        return Arr::only($this->items, [
            'name',
            'oked_company',
            'oked',
            'kato',
            'krp',
            'kato_company',
        ]);
    }

    final public function getPrograms(): array
    {
        $programs = [];

        foreach ($this->items[self::ResponseFieldPrograms] as $program)
        {
            $programs[] = new ProgramInfo($program);
        }

        return $programs;
    }


}

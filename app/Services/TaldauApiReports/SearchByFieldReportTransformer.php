<?php

namespace App\Services\TaldauApiReports;

class SearchByFieldReportTransformer
{

    final public function transform(array $rows, string $value = 'Г.АЛМАТЫ', string $key = 'text'): array
    {
        $items = collect($rows)->where($key, $value);

        return $items->count()
            ? $items->first()
            : [];
    }

}

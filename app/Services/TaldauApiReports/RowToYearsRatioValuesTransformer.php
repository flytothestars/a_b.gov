<?php

namespace App\Services\TaldauApiReports;

use Carbon\Carbon;
use Illuminate\Support\Str;

class RowToYearsRatioValuesTransformer
{

    final public function transform(array $row): array
    {
        $ratios = [];

        foreach ($row as $date => $value) {

            if($value === 'x')
            {
                $value = 0;
            }

            if (strpos($date, 'y') === 0) {
                $formattedDate            = Carbon
                    ::createFromFormat('mY', Str::substr($date, 1))
                    ->day(1)
                    ->format('Y-m-d')
                ;
                $ratios[ $formattedDate ] = $value;
            }
        }

        return $ratios;
    }

}

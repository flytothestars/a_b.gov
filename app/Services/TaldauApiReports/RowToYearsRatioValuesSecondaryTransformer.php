<?php

namespace App\Services\TaldauApiReports;

use Carbon\Carbon;
use Illuminate\Support\Str;

class RowToYearsRatioValuesSecondaryTransformer
{

    final public function transform(array $row): array
    {
        $ratios = [];

        foreach ($row as $date => $value) {
            if ($value === 'x') {
                $value = 0;
            }

            if (preg_match('~^\d{6}$~', $date)) {
                $formattedDate            = Carbon
                    ::createFromFormat('mY', $date)
                    ->day(1)
                    ->format('Y-m-d')
                ;
                $ratios[ $formattedDate ] = $value;
            }
        }

        return $ratios;
    }

}

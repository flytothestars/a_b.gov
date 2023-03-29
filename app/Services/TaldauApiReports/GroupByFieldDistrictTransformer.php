<?php

namespace App\Services\TaldauApiReports;

use App\Models\District;
use Illuminate\Support\Str;

class GroupByFieldDistrictTransformer
{

    final public function transform(array $rows): array
    {
        $districts = District
            ::all()
            ->map(
                function ($item)
                {
                    return [
                        'name' => Str::lower($item->name),
                        'id'   => $item->id,
                    ];
                }
            )
            ->pluck('id', 'name')
        ;
        foreach ($rows as $key => $row) {
            $district    = trim(Str::replace('район', '', Str::lower($row[ 'text' ])));
            $district_id = $districts[ $district ] ?? null;
            if ($district_id) {
                $rows[ $key ][ 'district_id' ] = $district_id;
            } else {
                unset($rows[ $key ]);
            }
        }
        return $rows;
    }

}

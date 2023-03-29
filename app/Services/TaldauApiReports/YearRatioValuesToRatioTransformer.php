<?php

namespace App\Services\TaldauApiReports;

use App\Repositories\Enums\Reports\IReportTypeEnum;

class YearRatioValuesToRatioTransformer
{

    final public function transform(
        string $city_id,
        string $report_type_id,
        string $ratio_id,
        array $row,
        string $district_id = null
    ): array
    {
        $ratios = [];
        foreach ($row as $date => $value) {
            $ratio = [
                'city_id'        => $city_id,
                'report_type_id' => $report_type_id,
                'ratio_id'       => $ratio_id,
                'date'           => $date,
                'value'          => $value,
            ];

            if ($district_id) {
                $ratio [ 'district_id' ] = $district_id;
            }
            $ratios[] = $ratio;
        }
        return $ratios;
    }

}

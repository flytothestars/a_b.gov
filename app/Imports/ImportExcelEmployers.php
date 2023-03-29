<?php

namespace App\Imports;

use App\Models\EntityBus;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportExcelEmployers implements ToModel
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {
        return new Employer([
            'bin_iin' => $row[0],
            'risk_degree' => $row[1],
            'code_no' => $row[2]
        ]);
    }
}
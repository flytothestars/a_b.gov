<?php

namespace App\Imports;

use App\Models\MioIDModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;

class MioID implements ToCollection
{
    public function collection(Collection $rows): Collection
    {
        foreach ($rows as $row)
        {
            MioIDModel::create([
                'uuid' => $row[0],
            ]);
        }
        return $rows;
    }
}

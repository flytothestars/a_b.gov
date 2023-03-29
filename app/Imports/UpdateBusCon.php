<?php

namespace App\Imports;

use App\Models\UpdateBus;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;

class UpdateBusCon implements ToCollection
{
    public function collection(Collection $rows): Collection
    {
//        return $rows;
        foreach ($rows as $row)
        {
            UpdateBus::create([
                'company_name' => $row[0],
                'contact_name' => $row[1],
                'content'    => $row[2],
                'category' => $row[3],
                'status' => $row[4],
                'date' => $row[5],
                'comment' => $row[6],
            ]);
        }
        return $rows;
    }
//    public function model(array $row): UpdateBus
//    {
//        return new UpdateBus([
//            'company_name' => $row[0],
//            'contact_name' => $row[1],
//            'content'    => $row[2],
//            'category' => $row[3],
//            'status' => $row[4],
//            'date' => $row[5],
//            'comment' => $row[6],
//        ]);
//    }
}

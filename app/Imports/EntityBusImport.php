<?php

namespace App\Imports;

use App\Models\EntityBus;
use Maatwebsite\Excel\Concerns\ToModel;

class EntityBusImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {
        return new EntityBus([
            'business_uid' => $row[0],
            'name'    => $row[1],
            'display_name' => $row[2],
            'location' => $row[3],
            'address_line' => $row[4],
            'address_line_stat' => $row[5],
            'region_uid' => $row[6],
            'district_uid' => $row[7],
            'source' => $row[8],
            'activity_subclasses' => $row[9],
            'employee_count' => $row[10],
            'has_cash_register' => $row[11],
            'cash_register_count' => $row[12],
            'need_to_contact' => $row[13],
            'refused_to_provide_identification_number' => $row[14],
            'identification_number_not_found_in_stat' => $row[15],
            'status' => $row[16],
            'status_changed' => $row[17],
            'created' => $row[18],
            'modified' => $row[19],
            'industries' => $row[20],
            'entities' => $row[21],
            'entity_name' => $row[22],
            'entity_full_name' => $row[23],
            'entity_identification_number' => $row[24],
            'entity_activity_codes' => $row[25],
            'entity_is_individual' => $row[26],
            'activity_comment' => $row[27],
            'last_request_date' => $row[28],
        ]);
    }
}
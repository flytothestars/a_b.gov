<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Region;
use Illuminate\Database\Seeder;

class CitiesAdd extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->fillcity('25c728b6-f78e-4fbf-9128-c7bca032874f','Алматы', 'c69ac69b-3b24-4885-bb7d-28fe6186abc6');
       
    }

    private function fillcity($guid, $name, $mio_id)
    {
        City::query()->updateOrCreate([
            'id' => $guid,
            'name' => $name,
            'mio_id' => $mio_id
        ]);
    }
}

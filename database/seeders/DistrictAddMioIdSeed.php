<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\District;
use App\Models\Region;
use Illuminate\Database\Seeder;

class DistrictAddMioIdSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->updateDistrict('Жетысуский', '968e40fe-cfaa-4e0d-af47-5a93e5ad9c34');
        $this->updateDistrict('Алатауский', 'a9dc2bff-d317-4151-8cae-a078f2220c6b');
        $this->updateDistrict('Бостандыкский', '13b205a7-1887-4b0e-b8e2-cbc158212248');
        $this->updateDistrict('Алмалинский', '2720c247-d42f-4ffc-bcd7-087e4feb3da0');
        $this->updateDistrict('Турксибский', 'ef3e979a-a027-4fac-a24a-4e670ca80127');
        $this->updateDistrict('Наурызбайский', '8ea3b01b-25d6-4718-b3b6-d1b1098063bd');
        $this->updateDistrict('Медеуский', '76fbb403-b839-41c5-a821-223193dd389e');
        $this->updateDistrict('Ауэзовский', '2e28f364-2e86-45ee-8cb2-546373a93f05');
    }

    private function updateDistrict($name, $mio_id)
    {
        $city = City::query()->first();
        District::query()->updateOrCreate([
            'name' => $name
        ], [
            'name' => $name,
            'mio_id' => $mio_id,
            'city_id' => $city->id
        ]);
    }
}

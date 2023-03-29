<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\District;

class DistrictsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lists = [
            ['id'=> '5b56bea2-1583-49b6-93f9-34305e700e79',  'name' => 'Алатауский'],
            ['id'=> '64b4e789-47b0-440a-b498-e26921555ff8',  'name' => 'Алмалинский'],
            ['id'=> '52813f0a-c445-43dd-9593-9a19354c4fa0',  'name' => 'Ауэзовский'],
            ['id'=> '8e1b724b-11a3-4e61-9937-c8b4bf25aa44',  'name' => 'Бостандыкский'],
            ['id'=> 'c661dde6-793c-4658-a97f-5c581d1cf472',  'name' => 'Жетысуский'],
            ['id'=> '6d8b187d-440d-415d-8cfb-8ff7cc42f0bb',  'name' => 'Медеуский'],
            ['id'=> '5f82d4d4-c276-4ecd-af9c-fdcdefc8ce4b',  'name' => 'Наурызбайский'],
            ['id'=> 'b5b54335-2a9c-4660-ae5e-c53622b2c790',  'name' => 'Турксибский']
        ];
        foreach ($lists as $list) {
            District::query()->create([
                'id' => $list['id'],
                'name' => $list['name']
            ]);

        }
    }
}

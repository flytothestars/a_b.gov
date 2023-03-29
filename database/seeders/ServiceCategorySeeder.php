<?php


namespace Database\Seeders;


use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;

class ServiceCategorySeeder extends Seeder
{
    public function run() : void
    {
        $serviceGroupList = [
            ['id'=> '61163fe6-7ea1-47c2-9248-5336b6d45d9b','no' => 1,  'name' => 'Финансовые услуги'],
            ['id'=> '91da119d-478f-497e-b966-1c8d7f0f9013','no' => 2,  'name' => 'Консультации и Сопровождение'],
            ['id'=> 'fbb01f82-6ffb-4e4f-b283-aa80ce1037d3','no' => 3,  'name' => 'Помощь в Разрешительных Документах'],
            ['id'=> '86fb5edc-82db-47d4-ab31-e9a9285b16ab','no' => 4,  'name' => 'Бесплатное Обучение'],
        ];
        foreach ($serviceGroupList as $serviceGroup) {
            $newServiceGroup = ServiceCategory::query()->create(['id' => $serviceGroup['id'],'name' => $serviceGroup['name'], 'order_no' => $serviceGroup['no']]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\ServiceGroup;
use App\Models\StorageFile;
use App\Models\User;
use Illuminate\Database\Seeder;

class ServiceGroupSeeder extends Seeder
{
    public function run() : void
    {
        $serviceGroupList = [
            ['id'=> '61163fe6-7ea1-47c2-9248-5336b6d45d9b','no' => 1,  'name' => 'Подбор финансирования'],
            ['id'=> '91da119d-478f-497e-b966-1c8d7f0f9013','no' => 2,  'name' => 'Бесплатное обучение'],
            ['id'=> 'fbb01f82-6ffb-4e4f-b283-aa80ce1037d3','no' => 3,  'name' => 'Бизнес навигатор'],
            ['id'=> '86fb5edc-82db-47d4-ab31-e9a9285b16ab','no' => 4,  'name' => 'Разрешительные документы'],
            ['id'=> '08ff3cab-5127-4237-8b93-54bd8764b4f5','no' => 5,  'name' => 'Найти помещение'],
            ['id'=> 'fa8e1bd0-c01b-4492-8d57-b4510cdf5324','no' => 6,  'name' => 'Местные поставщики'],
        ];
        foreach ($serviceGroupList as $serviceGroup) {
            $newServiceGroup = ServiceGroup::query()->create(['id' => $serviceGroup['id'],'name' => $serviceGroup['name'], 'order_no' => $serviceGroup['no']]);
            StorageFile::query()->create([
                'storable_id' => $newServiceGroup->id,
                'storable_type' => ServiceGroup::class,
                'path' => 'serviceGroup/service' . $serviceGroup['no'] . '.svg',
                'file_type' => 'picture',
            ]);
        }
    }
}

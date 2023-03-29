<?php

namespace Database\Seeders;

use App\Models\ServiceGroup;
use App\Models\StorageFile;
use App\Models\User;
use Illuminate\Database\Seeder;

class ServiceGroupInfrastructureSeeder extends Seeder
{
    public function run() : void
    {
        $serviceGroupList = [
            ['id'=> '81d51d67-700d-476c-aae4-1e3571b8e84e','no' => 7,  'name' => 'Коммунальная инфраструктура']
        ];
        foreach ($serviceGroupList as $serviceGroup) {
            $newServiceGroup = ServiceGroup::query()->create(['id' => $serviceGroup['id'],'name' => $serviceGroup['name'], 'order_no' => $serviceGroup['no']]);
        }
    }
}

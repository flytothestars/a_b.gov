<?php


namespace Database\Seeders;


use App\Models\FrontViewServiceGroup;
use App\Models\StorageFile;
use Illuminate\Database\Seeder;

class servicesInfrastructureSeeder extends Seeder
{
    public function run(): void
    {
        $serviceGroupList = [
            ['id' => '929fece6-849e-47eb-98a4-d0a796269670', 'no' => 3, 'name'=>'Коммунальная инфраструктура', 'remote_url' => '/servicesInfrastructure']
        ];

        foreach ($serviceGroupList as $serviceGroup) {
            $newServiceGroup = FrontViewServiceGroup::query()->where('id' , $serviceGroup['id'])->update([ 'name' => $serviceGroup['name'], 'order_no' => $serviceGroup['no'], 'remote_url' => $serviceGroup['remote_url']]);
        }
    }
}

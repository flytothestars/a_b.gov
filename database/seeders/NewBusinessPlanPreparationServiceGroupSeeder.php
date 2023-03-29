<?php

namespace Database\Seeders;

use App\Models\ServiceGroup;
use App\Models\StorageFile;
use App\Models\User;
use Illuminate\Database\Seeder;

class NewBusinessPlanPreparationServiceGroupSeeder extends Seeder
{
    public function run() : void
    {
        $serviceGroupList = [
            ['id'=> '08ff3cab-5127-4237-8b93-54bd8764b4f5', 'remote_service_url'=> '/site/startBusiness' ],
            ['id'=> 'fa8e1bd0-c01b-4492-8d57-b4510cdf5324', 'remote_service_url'=> '/site/businessPlanPreparation' ],
        ];
        foreach ($serviceGroupList as $serviceGroup) {
            $newServiceGroup = ServiceGroup::query()->where('id', $serviceGroup['id'])->update(['remote_service_url' => $serviceGroup['remote_service_url']]);
        }
    }
}

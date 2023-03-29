<?php

namespace Database\Seeders;

use App\Models\ServiceGroup;
use App\Models\StorageFile;
use App\Models\User;
use Illuminate\Database\Seeder;

class NewSelectionFinancingServiceGroupSeeder extends Seeder
{
    public function run() : void
    {
        $serviceGroupList = [
            ['id'=> '61163fe6-7ea1-47c2-9248-5336b6d45d9b', 'remote_service_url'=> '/site/financingPrograms' ],
        ];
        foreach ($serviceGroupList as $serviceGroup) {
            $newServiceGroup = ServiceGroup::query()->where('id', $serviceGroup['id'])->update(['remote_service_url' => $serviceGroup['remote_service_url']]);
        }
    }
}

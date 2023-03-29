<?php

namespace Database\Seeders;

use App\Models\ServiceGroup;
use App\Models\StorageFile;
use App\Models\User;
use Illuminate\Database\Seeder;

class ChangeOrderOfServiceGroupSeederRemoteUrl extends Seeder
{
    public function run(): void
    {
        $serviceGroupList = [
            ['id' => '61163fe6-7ea1-47c2-9248-5336b6d45d9b', 'remote_service_url' => '/site/financingPrograms'],
            ['id' => '91da119d-478f-497e-b966-1c8d7f0f9013', 'remote_service_url' => 'https://edu.qolday.kz/login/index.php'],
            ['id' => '86fb5edc-82db-47d4-ab31-e9a9285b16ab', 'remote_service_url' => 'http://almatybusiness.gov.kz/site/permittingDocuments'],
        ];
        foreach ($serviceGroupList as $serviceGroup) {
            $newServiceGroup = ServiceGroup::query()->updateOrCreate(['id' => $serviceGroup['id']], ['remote_service_url' => $serviceGroup['remote_service_url']]);

        }
    }
}

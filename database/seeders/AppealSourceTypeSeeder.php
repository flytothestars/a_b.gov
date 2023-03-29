<?php

namespace Database\Seeders;

use App\Models\AppealSourceType;
use App\Repositories\Enums\AppealSourceTypeEnum;
use Illuminate\Database\Seeder;

class AppealSourceTypeSeeder extends Seeder
{

    public function run()
    {
        $statusList = [
            ['id' => AppealSourceTypeEnum::Portal, 'name' => 'Портал'],
            ['id' => AppealSourceTypeEnum::MIO, 'name' => 'МИО'],
            ['id' => AppealSourceTypeEnum::CALL_CENTER, 'name' => 'Колл Центр'],
        ];

        foreach ($statusList as $status) {
            AppealSourceType::query()->updateOrCreate([
                'id' => $status['id'],
            ], [
                'name' => $status['name']
            ]);
        }
    }
}

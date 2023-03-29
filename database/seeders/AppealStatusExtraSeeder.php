<?php

namespace Database\Seeders;

use App\Models\AppealStatus;
use App\Repositories\Enums\AppealStatusEnum;
use Illuminate\Database\Seeder;

class AppealStatusExtraSeeder extends Seeder
{
    public function run()
    {
        $statusList = [
            ['id' => AppealStatusEnum::ExecutorAssigned, 'name' => 'Назначен исполнитель'],
        ];
        foreach ($statusList as $status) {
            AppealStatus::query()->create([
                'id' => $status['id'],
                'name' => $status['name']
            ]);
        }
    }
}

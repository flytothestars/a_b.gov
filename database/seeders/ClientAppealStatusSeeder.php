<?php

namespace Database\Seeders;

use App\Models\ClientAppealStatus;
use App\Repositories\Enums\ClientAppealStatusEnum;
use Illuminate\Database\Seeder;

class ClientAppealStatusSeeder extends Seeder
{
    public function run()
    {
        $statusList = [
            ['id' => ClientAppealStatusEnum::Draft, 'name' => 'Черновик'],
            ['id' => ClientAppealStatusEnum::Completed, 'name' => 'Исполнен'],
            ['id' => ClientAppealStatusEnum::InWork, 'name' => 'В работе'],
            ['id' => ClientAppealStatusEnum::Pending, 'name' => 'Ожидает рассмотрения'],
            ['id' => ClientAppealStatusEnum::Rejected, 'name' => 'Отказан'],

        ];
        foreach ($statusList as $status) {
            ClientAppealStatus::query()->create([
                'id' => $status['id'],
                'name' => $status['name']
            ]);
        }
    }
}

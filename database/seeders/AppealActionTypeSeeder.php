<?php

namespace Database\Seeders;

use App\Models\AppealActionType;
use App\Repositories\Enums\AppealActionTypeEnum;
use Illuminate\Database\Seeder;

class AppealActionTypeSeeder extends Seeder
{

    public function run()
    {
        $statusList = [
            ['id' => AppealActionTypeEnum::DataChanged, 'name' => 'Изменение данных'],
            ['id' => AppealActionTypeEnum::ExecutorAssigned, 'name' => 'Назначенен исполнитель'],
            ['id' => AppealActionTypeEnum::CoExecutorAssigned, 'name' => 'Назначен соисполнитель'],
            ['id' => AppealActionTypeEnum::DistributorAssigned, 'name' => 'Назначен дистрибьютор'],
            ['id' => AppealActionTypeEnum::Confirmed, 'name' => 'Подтвержден'],
            ['id' => AppealActionTypeEnum::Completed, 'name' => 'Исполнен'],
            ['id' => AppealActionTypeEnum::Rejected, 'name' => 'Отказан'],
            ['id' => AppealActionTypeEnum::Returned, 'name' => 'Возврат на доработку'],
            ['id' => AppealActionTypeEnum::CuratorAssigned, 'name' => 'Назначенен куратор'],
            ['id' => AppealActionTypeEnum::CantContact, 'name' => 'Не дозвонились'],
        ];
        foreach ($statusList as $status) {
            AppealActionType::query()->updateOrCreate(
                ['id' => $status['id']],
                ['name' => $status['name']]);
        }
    }
}

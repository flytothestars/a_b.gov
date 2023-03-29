<?php

namespace Database\Seeders;

use App\Models\AppealStatus;
use App\Models\CategoryAppeal;
use App\Repositories\Enums\AppealStatusEnum;
use Illuminate\Database\Seeder;

class AppealStatusSeeder extends Seeder
{

    public function run()
    {
        $statusList = [
            ['id' => AppealStatusEnum::CoExecutorAssigned, 'name' => 'Назначен соисполнитель'],
            ['id' => AppealStatusEnum::Completed, 'name' => 'Исполнен'],
            ['id' => AppealStatusEnum::Confirmed, 'name' => 'На подтверждении'],
            ['id' => AppealStatusEnum::InWork, 'name' => 'В работе'],
            ['id' => AppealStatusEnum::DistributorAssigned, 'name' => 'На распределении'],
            ['id' => AppealStatusEnum::Pending, 'name' => 'Ожидает рассмотрения'],
            ['id' => AppealStatusEnum::Rejected, 'name' => 'Отказан'],
            ['id' => AppealStatusEnum::CuratorAssigned, 'name' => 'Назначен куратор'],
            ['id' => AppealStatusEnum::DivisionCuratorConfirm, 'name' => 'Подтверждено куратором подразделения'],
            ['id' => AppealStatusEnum::DistrictCuratorConfirm, 'name' => 'Подтверждено куратором района'],
            ['id' => AppealStatusEnum::OnConfirmDistrictCurator, 'name' => 'На подтверждении у куратора района'],

        ];
        foreach ($statusList as $status) {
            AppealStatus::query()->updateOrCreate(['id' => $status['id']],[
                'id' => $status['id'],
                'name' => $status['name']
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\AppealResultMatrix;
use App\Models\AppealResultType;
use App\Repositories\Enums\AppealResultTypeEnum;
use App\Repositories\Enums\AppealStatusEnum;
use App\Repositories\Enums\RoleEnum;
use App\Repositories\Enums\RoleIntEnum;
use Illuminate\Database\Seeder;

class AppealResultMatrixPart4Seeder extends Seeder
{

    public function run()
    {
        $matrixList = [
            ['from_appeal_status_id' => AppealStatusEnum::ExecutorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Completed, 'appeal_result_type_id' => AppealResultTypeEnum::CompletedByPhone, 'role_id' => RoleIntEnum::Distributor],
            ['from_appeal_status_id' => AppealStatusEnum::ExecutorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::ClientNoAnswer, 'role_id' => RoleIntEnum::Distributor],
            ['from_appeal_status_id' => AppealStatusEnum::ExecutorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::WrongContact, 'role_id' => RoleIntEnum::Distributor],
            ['from_appeal_status_id' => AppealStatusEnum::ExecutorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::NotActual, 'role_id' => RoleIntEnum::Distributor],
            ['from_appeal_status_id' => AppealStatusEnum::ExecutorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::NotResponsiblePerson, 'role_id' => RoleIntEnum::Distributor],
            ['from_appeal_status_id' => AppealStatusEnum::ExecutorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::NotNeedsIdentified, 'role_id' => RoleIntEnum::Distributor],
        ];

        foreach ($matrixList as $matrix) {
            AppealResultMatrix::query()->updateOrCreate(
                [
                    'from_appeal_status_id' => $matrix['from_appeal_status_id'],
                    'to_appeal_status_id' => $matrix['to_appeal_status_id'],
                    'appeal_result_type_id' => $matrix['appeal_result_type_id'],
                    'role_id' => $matrix['role_id']
                ],
                [
                    'from_appeal_status_id' => $matrix['from_appeal_status_id'],
                    'to_appeal_status_id' => $matrix['to_appeal_status_id'],
                    'appeal_result_type_id' => $matrix['appeal_result_type_id'],
                    'role_id' => $matrix['role_id']
                ]);
        }
    }
}

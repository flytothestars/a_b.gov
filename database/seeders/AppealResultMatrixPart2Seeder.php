<?php

namespace Database\Seeders;

use App\Models\AppealResultMatrix;
use App\Models\AppealResultType;
use App\Repositories\Enums\AppealResultTypeEnum;
use App\Repositories\Enums\AppealStatusEnum;
use App\Repositories\Enums\RoleEnum;
use App\Repositories\Enums\RoleIntEnum;
use Illuminate\Database\Seeder;

class AppealResultMatrixPart2Seeder extends Seeder
{

    public function run()
    {
        $matrixList = [
            ['from_appeal_status_id' => AppealStatusEnum::DistributorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Completed, 'appeal_result_type_id' => AppealResultTypeEnum::CompletedByPhone, 'role_id' => RoleIntEnum::Distributor],
            ['from_appeal_status_id' => AppealStatusEnum::DistributorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::ClientNoAnswer, 'role_id' => RoleIntEnum::Distributor],
            ['from_appeal_status_id' => AppealStatusEnum::DistributorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::WrongContact, 'role_id' => RoleIntEnum::Distributor],
            ['from_appeal_status_id' => AppealStatusEnum::DistributorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::NotActual, 'role_id' => RoleIntEnum::Distributor],
            ['from_appeal_status_id' => AppealStatusEnum::DistributorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::NotResponsiblePerson, 'role_id' => RoleIntEnum::Distributor],
            ['from_appeal_status_id' => AppealStatusEnum::DistributorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::NotNeedsIdentified, 'role_id' => RoleIntEnum::Distributor],

            ['from_appeal_status_id' => AppealStatusEnum::ExecutorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Completed, 'appeal_result_type_id' => AppealResultTypeEnum::CompletedInQoldauOffice, 'role_id' => RoleIntEnum::Manager],
            ['from_appeal_status_id' => AppealStatusEnum::ExecutorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::ClientDidNotComeToConsultation,'role_id' => RoleIntEnum::Manager ],
            ['from_appeal_status_id' => AppealStatusEnum::ExecutorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::CompletedWithoutQoldau, 'role_id' => RoleIntEnum::Manager],
            ['from_appeal_status_id' => AppealStatusEnum::ExecutorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::NotActual, 'role_id' => RoleIntEnum::Manager],
            ['from_appeal_status_id' => AppealStatusEnum::InWork, 'to_appeal_status_id' => AppealStatusEnum::Completed, 'appeal_result_type_id' => AppealResultTypeEnum::CompletedInQoldauOffice, 'role_id' => RoleIntEnum::Manager],
            ['from_appeal_status_id' => AppealStatusEnum::InWork, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::ClientDidNotComeToConsultation,'role_id' => RoleIntEnum::Manager ],
            ['from_appeal_status_id' => AppealStatusEnum::InWork, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::CompletedWithoutQoldau, 'role_id' => RoleIntEnum::Manager],
            ['from_appeal_status_id' => AppealStatusEnum::InWork, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::NotActual, 'role_id' => RoleIntEnum::Manager],

            ['from_appeal_status_id' => AppealStatusEnum::CoExecutorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Completed, 'appeal_result_type_id' => AppealResultTypeEnum::CompletedByCoExecutor, 'role_id' => RoleIntEnum::CoExecutor],
            ['from_appeal_status_id' => AppealStatusEnum::CoExecutorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::ClientDoesNotGetInTouch, 'role_id' => RoleIntEnum::CoExecutor],
            ['from_appeal_status_id' => AppealStatusEnum::CoExecutorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::CompletedByClient, 'role_id' => RoleIntEnum::CoExecutor],
            ['from_appeal_status_id' => AppealStatusEnum::CoExecutorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::NoLegalBasic, 'role_id' => RoleIntEnum::CoExecutor],

            ['from_appeal_status_id' => AppealStatusEnum::CuratorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Completed, 'appeal_result_type_id' => AppealResultTypeEnum::Completed, 'role_id' => RoleIntEnum::UpiCurator],
            ['from_appeal_status_id' => AppealStatusEnum::CuratorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::NotActual, 'role_id' => RoleIntEnum::UpiCurator],
            ['from_appeal_status_id' => AppealStatusEnum::CuratorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::NoLegalBasic, 'role_id' => RoleIntEnum::UpiCurator],
            ['from_appeal_status_id' => AppealStatusEnum::CuratorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::CompletedByClient, 'role_id' => RoleIntEnum::UpiCurator],
            ['from_appeal_status_id' => AppealStatusEnum::CuratorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::ClientDoesNotGetInTouch, 'role_id' => RoleIntEnum::UpiCurator],

            ['from_appeal_status_id' => AppealStatusEnum::CuratorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Completed, 'appeal_result_type_id' => AppealResultTypeEnum::Completed, 'role_id' => RoleIntEnum::DivisionCurator],
            ['from_appeal_status_id' => AppealStatusEnum::CuratorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::NotActual, 'role_id' => RoleIntEnum::DivisionCurator],
            ['from_appeal_status_id' => AppealStatusEnum::CuratorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::NoLegalBasic, 'role_id' => RoleIntEnum::DivisionCurator],
            ['from_appeal_status_id' => AppealStatusEnum::CuratorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::CompletedByClient, 'role_id' => RoleIntEnum::DivisionCurator],
            ['from_appeal_status_id' => AppealStatusEnum::CuratorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::ClientDoesNotGetInTouch, 'role_id' => RoleIntEnum::DivisionCurator],
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

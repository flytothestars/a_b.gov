<?php

namespace Database\Seeders;

use App\Models\AppealResultMatrix;
use App\Models\AppealResultType;
use App\Repositories\Enums\AppealResultTypeEnum;
use App\Repositories\Enums\AppealStatusEnum;
use Illuminate\Database\Seeder;

class AppealResultMatrixSeeder extends Seeder
{

    public function run()
    {
        $matrixList = [
            ['from_appeal_status_id' => AppealStatusEnum::DistributorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Completed, 'appeal_result_type_id' => AppealResultTypeEnum::CompletedByPhone],
            ['from_appeal_status_id' => AppealStatusEnum::DistributorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Completed, 'appeal_result_type_id' => AppealResultTypeEnum::NotActual],
            ['from_appeal_status_id' => AppealStatusEnum::DistributorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Completed, 'appeal_result_type_id' => AppealResultTypeEnum::NoLegalBasic],
            ['from_appeal_status_id' => AppealStatusEnum::DistributorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::ClientNoAnswer],
            ['from_appeal_status_id' => AppealStatusEnum::DistributorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::WrongContact],
            ['from_appeal_status_id' => AppealStatusEnum::DistributorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::NotActual],
            ['from_appeal_status_id' => AppealStatusEnum::DistributorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::CompletedWithoutQoldau],

            ['from_appeal_status_id' => AppealStatusEnum::InWork, 'to_appeal_status_id' => AppealStatusEnum::Completed, 'appeal_result_type_id' => AppealResultTypeEnum::CompletedInQoldauOffice],
            ['from_appeal_status_id' => AppealStatusEnum::InWork, 'to_appeal_status_id' => AppealStatusEnum::Completed, 'appeal_result_type_id' => AppealResultTypeEnum::NotActual],
            ['from_appeal_status_id' => AppealStatusEnum::InWork, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::ClientDidNotComeToConsultation],
            ['from_appeal_status_id' => AppealStatusEnum::InWork, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::CompletedWithoutQoldau],

            ['from_appeal_status_id' => AppealStatusEnum::ExecutorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Completed, 'appeal_result_type_id' => AppealResultTypeEnum::CompletedInQoldauOffice],
            ['from_appeal_status_id' => AppealStatusEnum::ExecutorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Completed, 'appeal_result_type_id' => AppealResultTypeEnum::NotActual],
            ['from_appeal_status_id' => AppealStatusEnum::ExecutorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Completed, 'appeal_result_type_id' => AppealResultTypeEnum::Completed],
            ['from_appeal_status_id' => AppealStatusEnum::ExecutorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::ClientDidNotComeToConsultation],
            ['from_appeal_status_id' => AppealStatusEnum::ExecutorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::NoLegalBasic],
            ['from_appeal_status_id' => AppealStatusEnum::ExecutorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::NotActual],
            ['from_appeal_status_id' => AppealStatusEnum::ExecutorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::CompletedWithoutQoldau],
            ['from_appeal_status_id' => AppealStatusEnum::ExecutorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::WrongContact],

            ['from_appeal_status_id' => AppealStatusEnum::CoExecutorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Completed, 'appeal_result_type_id' => AppealResultTypeEnum::CompletedByCoExecutor],
            ['from_appeal_status_id' => AppealStatusEnum::CoExecutorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::ClientDoesNotGetInTouch],
            ['from_appeal_status_id' => AppealStatusEnum::CoExecutorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::CompletedByClient],
            ['from_appeal_status_id' => AppealStatusEnum::CoExecutorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::NoLegalBasic],

            ['from_appeal_status_id' => AppealStatusEnum::CuratorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Completed, 'appeal_result_type_id' => AppealResultTypeEnum::Completed],
            ['from_appeal_status_id' => AppealStatusEnum::CuratorAssigned, 'to_appeal_status_id' => AppealStatusEnum::Rejected, 'appeal_result_type_id' => AppealResultTypeEnum::NotActual],
        ];

        foreach ($matrixList as $matrix) {
            AppealResultMatrix::query()->updateOrCreate(
                ['from_appeal_status_id' => $matrix['from_appeal_status_id'], 'to_appeal_status_id' => $matrix['to_appeal_status_id']],
                [
                'from_appeal_status_id' => $matrix['from_appeal_status_id'],
                'to_appeal_status_id' => $matrix['to_appeal_status_id'],
                'appeal_result_type_id' => $matrix['appeal_result_type_id']]);
        }
    }
}

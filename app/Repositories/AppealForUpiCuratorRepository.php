<?php

namespace App\Repositories;

use App\Models\Appeal;
use App\Models\AppealHistory;
use App\Models\User;
use App\Repositories\Enums\AppealActionTypeEnum;
use App\Repositories\Enums\AppealStatusEnum;
use App\Repositories\Enums\ClientAppealStatusEnum;
use App\Repositories\Enums\FlowTypeEnum;
use App\Repositories\Enums\RoleIntEnum;
use App\Services\Camunda\ICamundaService;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppealForUpiCuratorRepository extends AppealRepository implements IAppealForUpiCuratorRepository
{

    private $appealExecutorRepository;

    public function __construct(
        Appeal $model,
        IAppealExecutorRepository $appealExecutorRepository,
        IAppealHistoryRepository $appealHistoryRepository,
        IAppealDocumentRepository $appealDocumentRepository,
        IAppealDocumentHistoryRepository $appealDocumentHistoryRepository,
        IIntegrationJournalRepository $integrationJournalRepository,
        ICamundaService $camundaService
    )
    {
        parent::__construct(
            $model,
            $appealHistoryRepository,
            $appealDocumentRepository,
            $appealDocumentHistoryRepository,
            $integrationJournalRepository,
            $camundaService
        );
        $this->appealExecutorRepository = $appealExecutorRepository;
    }

    public function all(): Collection
    {
        return parent::query()
                     ->where('client_appeal_status_id', '!=', ClientAppealStatusEnum::Draft)
                     ->orderByDesc('createDate')
                     ->get()
            ;
    }

    public function allByFilter($attributes)
    {
        $query = $this->queryByFilter($attributes);

        $query = $query
            ->where('client_appeal_status_id', '!=', ClientAppealStatusEnum::Draft)
            ->orderByDesc('createDate')
        ;

        $perPage = null;
        if (array_key_exists('per_page', $attributes)) {
            $perPage = $attributes[ 'per_page' ];
        }

        return is_null($perPage)
            ? $query->get()
            : $query->paginate($perPage);
    }

    public function findAppealsByAuthUser($attributes)
    {
        $query = $this->queryByFilter($attributes);

        $query = $query
            ->where('client_appeal_status_id', '!=', ClientAppealStatusEnum::Draft)
            ->where('last_curator_upi_id', Auth::user()->id)
            ->orderByDesc('createDate')
        ;

        if(array_key_exists('appeal_status', $attributes)){
            $appealStatus = $attributes[ 'appeal_status' ];
            switch ($appealStatus){
                case 'to_work':{
                    $query = $query
                        ->whereNull('last_executor_id')
                        ->whereNotIn('appeal_status_id', [
                            AppealStatusEnum::Completed,
                            AppealStatusEnum::Rejected
                        ]);
                    break;
                }
                case 'in_work':{
                    $query = $query
                        ->whereNotNull('last_executor_id')
                        ->whereNotIn('appeal_status_id', [AppealStatusEnum::Completed, AppealStatusEnum::Rejected])
                    ;
                    break;
                }
                case 'completed':{
                    $query = $query
                        ->whereIn('appeal_status_id', [AppealStatusEnum::Completed, AppealStatusEnum::Rejected]);
                    break;
                }
                case 'confirmation':{
                    $query = $query
                        ->whereIn('appeal_status_id', [AppealStatusEnum::Confirmed, AppealStatusEnum::DistrictCuratorConfirm]);
                    break;
                }
            }
        }

        $perPage = null;
        if (array_key_exists('per_page', $attributes)) {
            $perPage = $attributes[ 'per_page' ];
        }

        return is_null($perPage)
            ? $query->get()
            : $query->paginate($perPage);
    }

    public function assignExecutor($id, $attributes): ?Model
    {
        DB::beginTransaction();

        try {
            $entity = parent::update(
                $id,
                [
                    'comment'             => array_key_exists('comment', $attributes)
                        ? $attributes[ 'comment' ]
                        : null,
                    'appeal_status_id'    => AppealStatusEnum::ExecutorAssigned,
                    'district_id'         => $attributes[ 'district_id' ],
                    'last_action_type_id' => AppealActionTypeEnum::ExecutorAssigned,
                    'last_executor_id'    => $attributes[ 'executor_id' ],
                    'flow_type_id'        => FlowTypeEnum::Upi,
                ]
            );

            $this->appealExecutorRepository->assign($entity->id, $attributes[ 'executor_id' ]);

            DB::commit();

            return $entity;

        } catch (Exception $ex) {
            DB::rollback();
            throw $ex;
        }

    }

    public function complete($id, $attributes): ?Model
    {
        return parent::update(
            $id,
            [
                'appeal_status_id'        => AppealStatusEnum::Completed,
                'comment'                 => array_key_exists('comment', $attributes)
                    ? $attributes[ 'comment' ]
                    : null,
                'last_action_type_id'     => AppealActionTypeEnum::Completed,
                'appeal_result_type_id'   => array_key_exists('appeal_result_type_id', $attributes)
                    ?
                    $attributes[ 'appeal_result_type_id' ]
                    : null,
                'files' => $attributes['files'] ?? []
            ]
        );
    }

    public function reject($id, $attributes): ?Model
    {
        return parent::update(
            $id,
            [
                'appeal_status_id'        => AppealStatusEnum::Rejected,
                'client_appeal_status_id' => ClientAppealStatusEnum::Rejected,
                'comment'                 => $attributes[ 'comment' ],
                'last_action_type_id'     => AppealActionTypeEnum::Rejected,
                'appeal_result_type_id'   => array_key_exists('appeal_result_type_id', $attributes)
                    ?
                    $attributes[ 'appeal_result_type_id' ]
                    : null,
                'files' => $attributes['files'] ?? []
            ]
        );
    }

    public function backToWork($id): ?Model
    {
        DB::beginTransaction();

        $appealHistory = AppealHistory::query()
                                      ->where('appeal_id', $id)
                                      ->whereIn(
                                          'appeal_status_id',
                                          [
                                              AppealStatusEnum::InWork,
                                              AppealStatusEnum::ExecutorAssigned,
                                              AppealStatusEnum::CoExecutorAssigned,
                                          ]
                                      )
                                      ->orderByDesc('created_at')
                                      ->first()
        ;

        try {
            $entity = parent::update(
                $id,
                [
                    'appeal_status_id'    => $appealHistory
                        ? $appealHistory->appeal_status_id
                        : AppealStatusEnum::ExecutorAssigned,
                    'last_action_type_id' => AppealActionTypeEnum::Returned,
                ]
            );

            DB::commit();

            return $entity;

        } catch (Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }
}

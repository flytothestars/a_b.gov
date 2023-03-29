<?php

namespace App\Repositories;

use App\Models\Appeal;
use App\Models\AppealHistory;
use App\Repositories\Enums\AppealActionTypeEnum;
use App\Repositories\Enums\AppealStatusEnum;
use App\Repositories\Enums\ClientAppealStatusEnum;
use App\Services\Camunda\ICamundaService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class AppealForDivisionCuratorRepository extends AppealRepository implements IAppealForDivisionCuratorRepository
{
    public function __construct(
        Appeal                           $model,
        IAppealHistoryRepository         $appealHistoryRepository,
        IAppealDocumentRepository        $appealDocumentRepository,
        IAppealDocumentHistoryRepository $appealDocumentHistoryRepository,
        IIntegrationJournalRepository    $integrationJournalRepository,
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
    }

    public function all(): Collection
    {
        $currentDepartmentId = Auth::user()->profile->department_id;
        return parent::query()
            ->where('client_appeal_status_id', '!=', ClientAppealStatusEnum::Draft)
            ->whereHas(
                'executor.profile',
                function ($q) use ($currentDepartmentId) {
                    $q->where('department_id', $currentDepartmentId);
                }
            )
            ->orderByDesc('createDate')
            ->get();
    }

    public function allByFilter($attributes)
    {
        $currentDepartmentId = Auth::user()->profile->department_id;
        $query = $this->queryByFilter($attributes);

        $query = $query
            ->where('client_appeal_status_id', '!=', ClientAppealStatusEnum::Draft)
            ->whereHas(
                'executor.profile',
                function ($q) use ($currentDepartmentId) {
                    $q->where('department_id', $currentDepartmentId);
                }
            )
            ->orderByDesc('createDate');

        $perPage = null;
        if (array_key_exists('per_page', $attributes)) {
            $perPage = $attributes['per_page'];
        }

        return is_null($perPage)
            ? $query->get()
            : $query->paginate($perPage);
    }

    public function findAppealsByAuthUser($attributes)
    {
        $currentDepartmentId = Auth::user()->profile->department_id;

        $query = $this->queryByFilter($attributes);

        $query = $query
            ->where('client_appeal_status_id', '!=', ClientAppealStatusEnum::Draft)
            ->whereHas(
                'executor.profile',
                function ($q) use ($currentDepartmentId) {
                    $q->where('department_id', $currentDepartmentId);
                }
            )
            ->orderByDesc('createDate');

        if(array_key_exists('appeal_status', $attributes)) {
            $appealStatus = $attributes['appeal_status'];
            switch ($appealStatus) {
                case 'in_work':
                {
                    $query = $query
                        ->whereNotIn('appeal_status_id', [AppealStatusEnum::Completed, AppealStatusEnum::Rejected]);
                    break;
                }
                case 'completed':
                {
                    $query = $query
                        ->whereIn('appeal_status_id', [AppealStatusEnum::Completed, AppealStatusEnum::Rejected]);
                    break;
                }
                case 'confirmation':
                {
                    $query = $query
                        ->where('appeal_status_id', [AppealStatusEnum::Confirmed]);
                    break;
                }
            }
        }

        $perPage = null;
        if (array_key_exists('per_page', $attributes)) {
            $perPage = $attributes['per_page'];
        }

        return is_null($perPage)
            ? $query->get()
            : $query->paginate($perPage);
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
            ->first();

        try {
            $entity = parent::update(
                $id,
                [
                    'appeal_status_id' => $appealHistory
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

    public function complete($id, $attributes): ?Model
    {
        return parent::update(
            $id,
            [
                'appeal_status_id' => AppealStatusEnum::DivisionCuratorConfirm,
                'client_appeal_status_id' => AppealStatusEnum::Completed,
                'comment' => array_key_exists('comment', $attributes)
                    ? $attributes['comment']
                    : null,
                'last_action_type_id' => AppealActionTypeEnum::Confirmed,
                'appeal_result_type_id' => array_key_exists('appeal_result_type_id', $attributes)
                    ?
                    $attributes['appeal_result_type_id']
                    : null,
            ]
        );
    }
}

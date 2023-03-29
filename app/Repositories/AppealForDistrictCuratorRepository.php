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

class AppealForDistrictCuratorRepository extends AppealRepository implements IAppealForDistrictCuratorRepository
{

    private $appealCoExecutorRepository;

    public function __construct(
        Appeal $model,
        IAppealCoExecutorRepository $appealCoExecutorRepository,
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
        $this->appealCoExecutorRepository = $appealCoExecutorRepository;
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
            ->where('last_curator_district_id', Auth::user()->id)
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

    public function assignCoExecutor($id, $attributes): ?Model
    {
        DB::beginTransaction();

        try {
            $entity = parent::update(
                $id,
                [
                    'appeal_status_id'    => AppealStatusEnum::CoExecutorAssigned,
                    'comment'             => array_key_exists('comment', $attributes)
                        ? $attributes[ 'comment' ]
                        : null,
                    'last_action_type_id' => AppealActionTypeEnum::CoExecutorAssigned,
                    'last_coexecutor_id'  => $attributes[ 'co_executor_id' ],
                ]
            );

            $this->appealCoExecutorRepository->assign($entity->id, $attributes[ 'co_executor_id' ]);

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
                'appeal_status_id'        => AppealStatusEnum::DistrictCuratorConfirm,
                'comment'                 => array_key_exists('comment', $attributes)
                    ? $attributes[ 'comment' ]
                    : null,
                'last_action_type_id'     => AppealActionTypeEnum::Confirmed,
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
}

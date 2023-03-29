<?php

namespace App\Repositories;

use App\Models\Appeal;
use App\Repositories\Enums\AppealActionTypeEnum;
use App\Repositories\Enums\AppealStatusEnum;
use App\Repositories\Enums\ClientAppealStatusEnum;
use App\Repositories\Enums\FlowTypeEnum;
use App\Services\Camunda\ICamundaService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AppealForCoExecutorRepository extends AppealRepository implements IAppealForCoExecutorRepository
{
    public function __construct(
        Appeal $model,
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
    }

    public function find($id): ?Model
    {
        return parent::query()
                     ->whereIn(
                         'client_appeal_status_id',
                         [
                             ClientAppealStatusEnum::InWork,
                             ClientAppealStatusEnum::Rejected,
                             ClientAppealStatusEnum::Completed,
                         ]
                     )
//                     ->where('appeal_status_id', '!=', AppealStatusEnum::DistributorAssigned)
            ->where('last_coexecutor_id', Auth::user()->id)
                     ->where('id', '=', $id)
                     ->first()
            ;
    }

    public function findAppealsByAuthUser($attributes)
    {
        $query = $this->queryByFilter($attributes);

        $query = $query
            ->where('last_coexecutor_id', Auth::user()->id)
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

    public function all(): Collection
    {
        return parent::query()
                     ->where('client_appeal_status_id', '=', ClientAppealStatusEnum::InWork)
                     ->where('appeal_status_id', '!=', AppealStatusEnum::DistributorAssigned)
                     ->orderByDesc('createDate')
                     ->get()
            ;
    }

    public function allByFilter($attributes)
    {
        $query = $this->queryByFilter($attributes);

        $query = $query->where('client_appeal_status_id', '!=', ClientAppealStatusEnum::Draft)
                       ->where('appeal_status_id', '!=', AppealStatusEnum::DistributorAssigned)
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

    public function complete($id, $attributes): ?Model
    {
        $appeal = parent::find($id);
        $appealStatus = $appeal->flow_type_id == FlowTypeEnum::Qoldau ? AppealStatusEnum::Confirmed : AppealStatusEnum::OnConfirmDistrictCurator;

        return parent::update(
            $id,
            [
                'appeal_status_id'    => $appealStatus,
                'comment'             => array_key_exists('comment', $attributes)
                    ? $attributes[ 'comment' ]
                    : null,
                'last_action_type_id' => AppealActionTypeEnum::Confirmed,
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

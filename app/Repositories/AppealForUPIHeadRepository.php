<?php

namespace App\Repositories;

use App\Models\Appeal;
use App\Repositories\Enums\AppealStatusEnum;
use App\Repositories\Enums\ClientAppealStatusEnum;
use App\Repositories\Enums\FlowTypeEnum;
use App\Services\Camunda\ICamundaService;
use Illuminate\Database\Eloquent\Collection;

class AppealForUPIHeadRepository extends AppealRepository
    implements IAppealForUPIHeadRepository
{
    public function __construct(
        Appeal                           $model,
        IAppealExecutorRepository        $appealExecutorRepository,
        IAppealCoExecutorRepository      $appealCoExecutorRepository,
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
        $this->appealExecutorRepository = $appealExecutorRepository;
        $this->appealCoExecutorRepository = $appealCoExecutorRepository;
    }

    public function all(): Collection
    {
        return parent::query()
            ->where('client_appeal_status_id', '!=', ClientAppealStatusEnum::Draft)
            ->orderByDesc('createDate')
            ->get();
    }

    public function allByFilter($attributes)
    {
        $query = $this->queryByFilter($attributes);

        $query = $query
            ->where('client_appeal_status_id', '!=', ClientAppealStatusEnum::Draft)
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
        $query = $this->queryByFilter($attributes);

        $query = $query
            ->where('client_appeal_status_id', '!=', ClientAppealStatusEnum::Draft)
            ->orderByDesc('createDate');

        if (array_key_exists('appeal_status', $attributes)) {
            $appealStatus = $attributes['appeal_status'];
            switch ($appealStatus) {
                case 'upi.in_work':
                {
                    $query = $query
                        ->whereNotIn('appeal_status_id', [AppealStatusEnum::Completed, AppealStatusEnum::Rejected])
                        ->where('flow_type_id', FlowTypeEnum::Upi);
                    break;
                }
                case 'upi.completed':
                {
                    $query = $query
                        ->whereIn('appeal_status_id', [AppealStatusEnum::Completed, AppealStatusEnum::Rejected])
                        ->where('flow_type_id', FlowTypeEnum::Upi);
                    break;
                }
                case 'qolday.in_work':
                {
                    $query = $query
                        ->whereNotIn('appeal_status_id', [AppealStatusEnum::Completed, AppealStatusEnum::Rejected])
                        ->where(function ($query) {
                            $query->where('flow_type_id', FlowTypeEnum::Qoldau)
                                ->orWhereNull('flow_type_id');
                        });;
                    break;
                }
                case 'qolday.completed':
                {
                    $query = $query
                        ->whereIn('appeal_status_id', [AppealStatusEnum::Completed, AppealStatusEnum::Rejected])
                        ->where(function ($query) {
                            $query->where('flow_type_id', FlowTypeEnum::Qoldau)
                                ->orWhereNull('flow_type_id');
                        });
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


}

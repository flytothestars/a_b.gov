<?php

namespace App\Repositories;

use App\Models\Appeal;
use App\Repositories\Enums\AppealStatusEnum;
use App\Repositories\Enums\ClientAppealStatusEnum;
use App\Services\Camunda\ICamundaService;
use Illuminate\Database\Eloquent\Collection;

class AppealForHeadRepository extends AppealRepository
    implements IAppealForHeadRepository
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
        // $query->where('category_id','!=','b9f28fb2-3e63-4c10-a7e2-e99fbd4b3d67')->where('category_id','!=','6b82561d-48a3-43ca-9965-86b43491a03d');
        
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

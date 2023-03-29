<?php

namespace App\Repositories;

use App\Integration\Import\AppealImportFactory;
use App\Integration\Import\BusinessImportFactory;
use App\Integration\Import\IntegrationJournalModeEnum;
use App\Models\Business;
use App\Repositories\Enums\AppealStatusEnum;
use App\Repositories\Support\AutoAssignDistributorTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Enums\RoleIntEnum;
use App\Repositories\Enums\SourceTypeEnum;

class BusinessRepository extends MioBaseRepository implements IBusinessRepository
{
    use AutoAssignDistributorTrait;

    private IIntegrationJournalRepository $integrationJournalRepository;
    private BusinessImportFactory $businessImportFactory;

    public function __construct(Business $model, IIntegrationJournalRepository $integrationJournalRepository)
    {
        parent::__construct($model);
        $this->integrationJournalRepository = $integrationJournalRepository;

        $this->businessImportFactory = new BusinessImportFactory($integrationJournalRepository, new \App\Integration\MIORestClient());
    }

    public function create(array $attributes): Model
    {
        $entity = parent::create($attributes);

        if (is_null($entity->mio_id)) { //todo спросить у Асем
            $collection = collect($entity);
            $this->businessImportFactory->storeToJournal($collection, IntegrationJournalModeEnum::Create);
        }
        return $entity;
    }

    public function update($id, array $attributes): Model
    {
        $entity = parent::update($id, $attributes);

        $collection = collect($entity);
        $collection['entities'] = array($entity->organization_id);
        $activitySubclasses = array();
        foreach ($entity->businessActivityTypes as $businessActivityType){
            array_push($activitySubclasses, $businessActivityType->activityType->mio_id);
        }
        $collection['activity_subclasses'] = $activitySubclasses;

        $this->businessImportFactory->storeToJournal($collection, IntegrationJournalModeEnum::Update);

        return $entity;
    }


    public function getAppealBusinessById($business_id)
    {
        return parent::query()
            ->where('id', $business_id)
            ->first();
    }

    public function autoAssignDistributor($id): ?Model
    {
        $nextDistributor = $this->getNextDistributorForAutoAssignment();
        return $this->assignDistributor($id, optional($nextDistributor)->id);
    }

    private function assignDistributor($businessId, $userId): ?Model
    {
        $business = $this->findByMioId($businessId);
        $business->distributor_id = $userId;
        $business->save();
        
        return parent::find($businessId);
    }

    function allByDistributorId($distributor_id)
    {
        $date = Carbon::now()->subMonths(3);
        return parent::query()
            ->whereDoesntHave('appeals', function ($query) {
                $query
                    ->whereNotIn('appeals.appeal_status_id', [
                        AppealStatusEnum::Completed,
                        AppealStatusEnum::Rejected,
                        AppealStatusEnum::Confirmed,
                    ]);
            })
            ->where('distributor_id', $distributor_id)
            ->where(function ($query) use ($date) {
                $query->whereNull('last_call_date')
                    ->orWhere('last_call_date', '<', $date->format('Y-m-d H:i:s'));
            })
            ->orderByDesc('last_call_date')
            ->get();
    }

    function allByDistributorIdWithPagination($distributor_id, $itemsPerPage)
    {
        $date = Carbon::now()->subMonths(3);
        return parent::query()
            ->whereDoesntHave('appeals', function ($query) {
                $query
                    ->whereNotIn('appeals.appeal_status_id', [
                        AppealStatusEnum::Completed,
                        AppealStatusEnum::Rejected,
                        AppealStatusEnum::Confirmed,
                    ]);
            })
            ->where('distributor_id', $distributor_id)
            ->where(function ($query) use ($date) {
                $query->whereNull('last_call_date')
                    ->orWhere('last_call_date', '<', $date->format('Y-m-d H:i:s'));
            })
            ->orderByDesc('last_call_date')
            ->paginate($itemsPerPage);
    }

    public function all(): Collection
    {
        $model = $this->model->orderByDesc('last_call_date');

        if ($this->isTranslatebale)
            $model = $model->with("translations");

        if ($this->isStorable)
            $model = $model->with("files");

        return $model->get();
    }


    public function allByFilter(array $attributes)
    {
        $query = $this->queryByFilter($attributes);

        $perPage = null;
        if (array_key_exists('per_page', $attributes)) {
            $perPage = $attributes[ 'per_page' ];
        }
        if (array_key_exists('appeals', $attributes) && $attributes['appeals'] === 'has') {
            $query->whereHas('appeals');
        }else{
            $query->whereDoesntHave('appeals');
        }

        return is_null($perPage)
            ? $query->get()
            : $query->paginate($perPage);
    }

    public function allByFilterDistributor(array $attributes)
    {
        $query = $this->queryByFilter($attributes);

        $query->where('distributor_id', Auth::user()->id);

        $perPage = null;
        if (array_key_exists('per_page', $attributes)) {
            $perPage = $attributes[ 'per_page' ];
        }

        return is_null($perPage)
            ? $query->get()
            : $query->paginate($perPage);
    }

    public function queryByFilter($attributes): Builder
    {
        $query = parent::query();

        if (array_key_exists('city_id', $attributes)) {
            $query = $query->where('city_id', $attributes[ 'city_id' ]);
        }

        if (array_key_exists('district_id', $attributes)) {
            $query = $query->where('district_id', $attributes[ 'district_id' ]);
        }

        if (array_key_exists('distributor_id', $attributes)) {
            $query = $query->where('distributor_id', $attributes[ 'distributor_id' ]);
        }

        if (array_key_exists('start_date', $attributes)) {
            $query = $query->where('created', '>=', $attributes[ 'start_date' ]);
        }

        if (array_key_exists('end_date', $attributes)) {
            $query = $query->where('created', '<=', $attributes[ 'end_date' ]);
        }

        if (array_key_exists('status', $attributes)) {
            $query = $query->where('status', $attributes[ 'status' ]);
        }

        return $query;
    }


	public function getDataForSendingEmailBusinessManager()
    {
        $date = Carbon::now()->setTime(0, 0, 0, 0)->addDays(-1);
        return parent::query()
                     ->join('users', 'businesses.distributor_id', '=', 'users.id')
                     ->join('profiles', 'profiles.user_id', '=', 'users.id')
                     ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                     ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
                     ->join('organizations', 'organizations.id', '=', 'businesses.organization_id')
            //                     ->where('roles.id',  RoleIntEnum::Manager)
                    ->whereIn('businesses.source_type_id',  [SourceTypeEnum::MIO, SourceTypeEnum::CALL_CENTER])
                     ->where('created','>=' , $date)
                     ->get(['users.email', 'businesses.id', 'organizations.name as organizations_name', 'organizations.iin', 'profiles.last_name',
                     'profiles.first_name', 'profiles.second_name']);
    }

    public function setWorkingType($business_id, $workingType): ?Model
    {
        $business = $this->getAppealBusinessById($business_id);
        $business->working_type_id = $workingType;
        $business->save();

        return $business;
    }
}

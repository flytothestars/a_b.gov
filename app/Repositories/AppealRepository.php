<?php

namespace App\Repositories;

use App\Integration\Import\AppealImportFactory;
use App\Integration\Import\IntegrationJournalModeEnum;
use App\Models\Appeal;
use App\Models\AppealHistory;
use App\Models\Business;
use App\Models\User;
use App\Models\Organization;
use App\Repositories\Enums\AppealActionTypeEnum;
use App\Repositories\Enums\AppealStatusEnum;
use App\Repositories\Enums\ClientAppealStatusEnum;
use App\Repositories\Enums\FlowTypeEnum;
use App\Repositories\Enums\RoleEnum;
use App\Repositories\Enums\RoleIntEnum;
use App\Repositories\Support\AutoAssignDistributorTrait;
use App\Repositories\Support\IAutoAssignDistributor;
use App\Services\Camunda\ICamundaService;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use function Matrix\trace;
use App\Repositories\Enums\SourceTypeEnum;

class AppealRepository extends MioBaseRepository implements IAppealRepository
{
    private                                  $appealHistoryRepository;
    private IAppealDocumentRepository        $appealDocumentRepository;
    private IAppealDocumentHistoryRepository $appealDocumentHistoryRepository;
    private AppealImportFactory              $appealImportFactory;
    private ICamundaService                  $camundaService;

    public function __construct(
        Appeal $model,
        IAppealHistoryRepository $appealHistoryRepository,
        IAppealDocumentRepository $appealDocumentRepository,
        IAppealDocumentHistoryRepository $appealDocumentHistoryRepository,
        IIntegrationJournalRepository $integrationJournalRepository,
        ICamundaService $camundaService
    )
    {
        parent::__construct($model);
        $this->appealHistoryRepository         = $appealHistoryRepository;
        $this->appealDocumentRepository        = $appealDocumentRepository;
        $this->appealDocumentHistoryRepository = $appealDocumentHistoryRepository;
        $this->appealImportFactory             = new AppealImportFactory(
            $integrationJournalRepository,
            new \App\Integration\MIORestClient()
        );
        $this->camundaService                  = $camundaService;
    }

    public function getAppealsByUserId($user_id)
    {
        return parent::query()
                     ->where('user_id', $user_id)
                     ->orderByDesc('createDate')
                     ->paginate(10)
                     ->appends(request()->query())
            ;
    }

    public function getAllAppealsByUserId($user_id)
    {
        return parent::query()
                     ->where('user_id', $user_id)
                     ->orderByDesc('createDate')
                     ->get()
            ;
    }

    public function getAppealById($id)
    {
        return parent::query()
                     ->with(
                         [
                             'business',
                             'district',
                             'appealStatus',
                             'category',
                             'type',
                             'industry',
                         ]
                     )
                     ->where('id', $id)
                     ->first();
            ;
    }

    public function getAppealsByFilters($params = [])
    {
        if (!empty($params[ 'category' ])) {
            return parent::query()
                         ->where('user_id', Auth::id())
                         ->whereIn('category_id', $params[ 'category' ])
                         ->orderByDesc('createDate')
                         ->paginate(10)
                         ->appends(request()->query())
                ;
        }

        if (!empty($params[ 'status' ])) {
            return parent::query()
                         ->where('user_id', Auth::id())
                         ->whereIn('client_appeal_status_id', $params[ 'status' ])
                         ->orderByDesc('createDate')
                         ->paginate(10)
                         ->appends(request()->query())
                ;
        }

        if (!empty($params[ 'period' ])) {
            return parent::query()
                         ->where('user_id', Auth::id())
                         ->whereBetween('createDate', [ $params[ 'period' ] ])
                         ->orderByDesc('createDate')
                         ->paginate(10)
                         ->appends(request()->query())
                ;
        }

        if (empty($params)) {
            return parent::query()
                         ->where('user_id', Auth::id())
                         ->orderByDesc('createDate')
                         ->paginate(10)
                ;
        }
    }

    public function getByCode($code)
    {
        return parent::query()
                     ->where('id', $code)
                     ->first()
            ;
    }

    public function deleteByCode($code)
    {
        $this->appealHistoryRepository->getByAppeal($code)
                                      ->first()
                                      ->delete()
        ;
        return parent::query()
                     ->where('id', $code)
                     ->delete()
            ;
    }

    public function create(array $attributes): Model
    {
        if (!array_key_exists('last_action_type_id', $attributes)) {
            $attributes += [ 'last_action_type_id' => AppealActionTypeEnum::DataChanged ];
        }

        if (
            isset($attributes[ 'client_appeal_status_id' ], $attributes[ 'user_id' ])
            && $attributes[ 'client_appeal_status_id' ] !== ClientAppealStatusEnum::Draft
        ) {
            $attributes[ 'appeal_no' ] = $this->getNextClientNumber($attributes[ 'user_id' ]);
        }

        $entity = parent::create($attributes);
        $this->appealHistoryRepository->createByAppeal($entity);
        if ($entity->business_id && is_null($entity->mio_id)) { //todo спросить у Асем
            $collection                      = collect($entity);
            $collection[ 'requirement_id' ]  = $entity->external_category_id;
            $collection[ 'mio_business_id' ] = $entity->business->mio_id;
            $this->appealImportFactory->storeToJournal($collection, IntegrationJournalModeEnum::Create);
        }

        $this->camundaService->startProcess($entity->id);

        return $entity;
    }

    public function update($id, array $attributes): Model
    {
        $existEntity     = $this->model->findOrFail($id);
        $currentUserName = '';
        if (Auth::check()) {
            $currentUser = Auth::user();
            if ($currentUser) {
                $currentUserName = $currentUser->profile->full_name ?? optional($currentUser)->name;
            }
        }

        if (!array_key_exists('last_action_type_id', $attributes)) {
            $attributes += [ 'last_action_type_id' => AppealActionTypeEnum::DataChanged ];
        }

        if (
            isset($attributes[ 'client_appeal_status_id' ])
            && $attributes[ 'client_appeal_status_id' ] !== ClientAppealStatusEnum::Draft
        ) {
            if (
                $existEntity->client_appeal_status_id === ClientAppealStatusEnum::Draft
                && !$existEntity->appeal_no
            ) {
                $attributes[ 'appeal_no' ] = $this->getNextClientNumber($existEntity->user_id);
            }
        }

        $entity = parent::update($id, $attributes);

        if (isset($attributes[ 'change_category' ])) {
            $entity->comment = trans(
                'messages.action.change-category',
                [
                    'old_category' => $existEntity->category->name,
                    'new_category' => $entity->category->name,
                    'name'         => $currentUserName,
                ]
            );
        }

        if (Auth::check()) {
            if (
                array_key_exists('distributor_id', $attributes)
                && $existEntity->distributor_id !== $attributes[ 'distributor_id' ]
                && Auth::user()
                       ->hasRole(RoleEnum::Distributor)
            ) {
                $olDistributor      = $existEntity->distributor;
                $newDistributor     = User::find($attributes[ 'distributor_id' ]);
                $newDistributorName = $newDistributor->profile->full_name ?? $newDistributor->name;

                if ($olDistributor) {
                    $olDistributorName = $olDistributor->profile->full_name ?? $olDistributor->name;
                    $entity->comment   = trans(
                        'messages.action.change-distributor',
                        [
                            'head' => $currentUserName,
                            'old'  => $olDistributorName,
                            'new'  => $newDistributorName,
                        ]
                    );
                } else {
                    $entity->comment = trans(
                        'messages.action.change-distributor-one',
                        [
                            'head' => $currentUserName,
                            'new'  => $newDistributorName,
                        ]
                    );
                }
            }
        }

        $history = $this->appealHistoryRepository->createByAppeal($entity);

        if (array_key_exists('files', $attributes) && is_array($attributes[ 'files' ])) {
            foreach ($attributes[ 'files' ] as $file) {
                $file = $this->appealDocumentRepository->createManagerDocument($id, $file);
                $this->appealDocumentHistoryRepository->create(
                    [
                        'appeal_id'          => $entity->id,
                        'appeal_document_id' => $file->id,
                        'appeal_history_id'  => $history->id,
                    ]
                );
            }
        }

        if ($entity->business_id) { //todo спросить у Асем
            $collection                      = collect($entity);
            $collection[ 'requirement_id' ]  = $entity->external_category_id;
            $collection[ 'mio_business_id' ] = $entity->business->mio_id;
            $this->appealImportFactory->storeToJournal($collection, IntegrationJournalModeEnum::Update);
        }

        $entity->save();

        return $entity;
    }

    public function findAppealsByAuthUser($attributes)
    {
        return parent::query()
                     ->where('user_id', Auth::user()->id)
                     ->orderByDesc('createDate')
                     ->get()
            ;
    }

    public function allByFilter($attributes)
    {
        $query = $this->queryByFilter($attributes);

        $perPage = null;
        if (array_key_exists('per_page', $attributes)) {
            $perPage = $attributes[ 'per_page' ];
        }

        return is_null($perPage)
            ? $query->get()
            : $query->paginate($perPage);
    }

    public function allByFilterForExport($attributes)
    {
        $query = $this->queryByFilter($attributes);

        $query = $query
            ->where('client_appeal_status_id', '!=', ClientAppealStatusEnum::Draft)
            ->orderByDesc('createDate')
        ;

        return $query
            ->with(
                [
                    'client.profile',
                    'distributor.profile',
                    'executor.profile',
                    'coExecutor.profile',
                    'upiCurator.profile',
                    'business',
                    'business.organization',
                    'category',
                    'clientAppealStatus',
                    'appealSourceType',
                    'appealStatus',
                ]
            )
            ->get()
            ;
    }

    public function deleteDistributor() {
        ini_set('max_execution_time', 600);
        if (Auth::user()->hasRole(RoleEnum::Administrator)) {
            $query = parent::query();
            $appeals = $query->where('client_appeal_status_id', '=', '9454eb49-44c5-4c12-8316-a9650f203a8a')
                ->where('business_id', '!=', null)
                ->get();
            foreach($appeals as $appeal) {
                if(!$appeal->distributor_id) {
                    continue;
                }
                $business = Business::query()->find($appeal->business_id);
                $appealCheck= Appeal::query()->where('business_id', $appeal->business_id)->where('client_appeal_status_id', '=', 'f9840d9f-d405-4c17-9789-8d34b082ad06')->first();
                if(!$appealCheck) {
                    $business->distributor_id = null;
                    $business->save();
                    $appeal->distributor_id = null;
                    $appeal->save();
                }
            }
            echo 'Успешно удалено';
        } else {
            throw new RouteNotFoundException("Route not defined.");
        }
         //Удаление консультантов
    }

    public function test_one(int $id) {
        $query = parent::query();
        $appealsFilter = $query->whereNotNull('mio_id')->get();
        $businessIds = [];
        $distId = 0;
        for($i=$id; $i<count($appealsFilter); $i++) {
            $query = parent::query();
            // Обновления бизнеса и appeal
            $appealsCount = Appeal::query()->where('mio_id', '=', $appealsFilter[$i]->mio_id)
                ->count();
            if($appealsCount > 1) {
                $apCompleted = Appeal::query()->where('mio_id', '=', $appealsFilter[$i]->mio_id)->where('client_appeal_status_id', '=', 'f9840d9f-d405-4c17-9789-8d34b082ad06')
                    ->first();
                if($apCompleted) {
                    $apAll = Appeal::query()->where('mio_id', '=', $appealsFilter[$i]->mio_id)
                        ->get();
                    foreach ($apAll as $all) {
                        if($all->id != $apCompleted->id) {
                            $allHistory = AppealHistory::query()->where('appeal_id', $all->id)->get();
                            if ($allHistory) {
                                foreach ($allHistory as $history) {
                                    $history->delete();
                                }
                            }
                            echo $all->id . '/ ';
                            $all->delete();
                        }
                    }
                } else {
                    $apWork = Appeal::query()->where('mio_id', '=', $appealsFilter[$i]->mio_id)
                    ->first();
                    $apAll = Appeal::query()->where('mio_id', '=', $appealsFilter[$i]->mio_id)
                        ->get();
                    foreach ($apAll as $all) {
                        if($all->id != $apWork->id) {
                            $allHistory = AppealHistory::query()->where('appeal_id', $all->id)->get();
                            if ($allHistory) {
                                foreach ($allHistory as $history) {
                                    $history->delete();
                                }
                            }
                            echo $all->id . '/ ';
                            $all->delete();
                        }
                    }
                }
                echo $i.'\ ';
            } else {
                echo $i . '/ ';
            }
        }
    }

    public function test_two(int $isn) {
        dd($isn);
        $query = parent::query();
        $appealsFilter = $query->where('client_appeal_status_id', '=', 'f9840d9f-d405-4c17-9789-8d34b082ad06')
            ->get();
        $businessIds = [];
        $distId = 0;
        for($i=$isn; $i<count($appealsFilter); $i++) {
            $query = parent::query();
            // Обновления бизнеса и appeal
            $appealsCount = Appeal::query()->where('mio_id', '=', $appealsFilter[$i]->mio_id)
                ->count();
            if ($appealsCount > 1) {
                $apCompleted = Appeal::query()->where('mio_id', '=', $appealsFilter[$i]->mio_id)->where('client_appeal_status_id', '=', 'f9840d9f-d405-4c17-9789-8d34b082ad06')
                    ->first();
                if ($apCompleted) {
                    $apAll = Appeal::query()->where('mio_id', '=', $appealsFilter[$i]->mio_id)
                        ->get();
                    foreach ($apAll as $all) {
                        if ($all->id != $apCompleted->id) {
                            $allHistory = AppealHistory::query()->where('appeal_id', $all->id)->get();
                            if ($allHistory) {
                                foreach ($allHistory as $history) {
                                    $history->delete();
                                }
                            }
                            echo $all->id . '/ ';
                            $all->delete();
                        }
                    }
                }
                echo $i . '\ ';
            }
        }
    }

    public function testThree() {
        ini_set('max_execution_time', 600);
        if (Auth::user()->hasRole(RoleEnum::Administrator)) {
            $appeals = Appeal::query()->where('client_appeal_status_id', '=', '9454eb49-44c5-4c12-8316-a9650f203a8a')
                ->where('business_id', '!=', null)
                ->get();
            $businessIds = [];
            $distId = 0;
            foreach($appeals as $appeal) {
//            $businessIds[] = $appeal->business_id;
                $business = Business::query()->where('id', '=', $appeal->business_id)
                    ->where('distributor_id', '=', null)->first();
                if($business) {
                    $appealCheck = Appeal::query()->where('business_id', $appeal->business->id)->where('client_appeal_status_id', '=', 'f9840d9f-d405-4c17-9789-8d34b082ad06')->first();
                }
                echo $business->organization->iin ?? '';
                // Обновления бизнеса и appeal
                if ($business && !$appealCheck) {
                    $distId = $this->nextDistributorForBusiness($distId);
                    $business->distributor_id = $distId;
                    $business->save();
                    echo $distId;
//                $app = Appeal::query()->where('business_id', '=', $business->id)->get();
//                foreach ($app as $a) {
                    $appeal->distributor_id = $distId;
                    $appeal->save();
                    $appHistories = AppealHistory::query()
                        ->where('appeal_id', '=', $appeal->id)->get();
                    foreach ($appHistories as $appHistory) {
                        $appHistory->distributor_id = $distId;
                        $appHistory->save();
                    }
//                }
                }
//            }
            }
            echo 'Успешно распределено!';
        } else {
            throw new RouteNotFoundException("Route not defined.");
        }
    }

    public function extraDivide()
    {
        ini_set('max_execution_time', 600);
        if (Auth::user()->hasRole(RoleEnum::Administrator)) {
            $appeals = Appeal::query()->where('client_appeal_status_id', '=', '9454eb49-44c5-4c12-8316-a9650f203a8a')
                ->where('distributor_id', '=', null)
                ->get();
            foreach($appeals as $appeal) {
//            $businessIds[] = $appeal->business_id;
                $business = Business::query()->where('id', '=', $appeal->business_id)
                    ->where('distributor_id', '!=', null)->first();
                // Обновления бизнеса и appeal
                if ($business) {
                    $appeal->distributor_id = $business->distributor_id;
                    $appeal->save();
                }
//            }
            }
            echo 'Успешно распределено extra!';
        } else {
            throw new RouteNotFoundException("Route not defined.");
        }
    }

    public function extraDivideDistributor(int $isn, int $count)
    {
        $appeals = Appeal::query()
                ->where('distributor_id', '=', $isn)
                ->get();
        $distId = 0;
        if(count($appeals) > 0) {
            foreach($appeals as $appeal) {
                $distId = $this->nextDistributorForBusiness($distId);
                $business = Business::query()->where('id', '=', $appeal->business_id)->first();
                if ($business) {
                    $business->distributor_id = $distId;
                    $business->save();
                }
                echo $distId.' ';
                $appeal->distributor_id = $distId;
                $appeal->save();
                $appHistories = AppealHistory::query()
                    ->where('appeal_id', '=', $appeal->id)->get();
                if($appHistories) {
                    foreach ($appHistories as $appHistory) {
                        $appHistory->distributor_id = $distId;
                        $appHistory->save();
                    }
                }
            }
        }    
    }

    public function nextDistributorForBusiness($id) {
//        if($id === 0) {
//            return 82;
//        }
//        if($id === 82) {
//            return 4828;
//        }
//        if ($id === 4828) {
//            return 4830;
//        }
//        if ($id === 4830) {
//            return 82;
//        }
        $roles = DB::table('model_has_roles')->where('role_id','=',4)->get();
        $distributors = [];
        foreach ($roles as $role) {
            $distributors[] = $role->model_id;
        }
        if (count($distributors) === 0) {
            dd('Нет данных Роль distributor в таблице model_has_roles ');
        }
        if ($id === 0) {
            return $distributors[0];
        }
        if($id === end($distributors)) {
            return $distributors[0];
        }
//        current($distributors) = $id;
//        if($id === current($distributors)) {
//            return next($distributors);
//        }
        for ($i=0; $i<count($distributors); $i++) {
            if ($id === $distributors[$i]) {
                return $distributors[$i + 1];
            }
        }
    }

    public function getDistributor() {
        if (Auth::user()->hasRole(RoleEnum::Administrator)) {
            $roles = DB::table('model_has_roles')->where('role_id','=',4)->get();
            $distributors = [];
            $id = 0;
            foreach ($roles as $role) {
                $distributors[] = $role->model_id;
                $user = User::query()->where('id', $role->model_id)->first();
                echo $user->phone . "<br/>";
            }
//        dd($distributors);
            if (count($distributors) === 0) {
                dd('нет подключении либо не нашли в таблице model_has_roles Роль distributor');
            }
//        for($i=0; $i<count($distributors); $i++) {
//            if($id === 0) {
//                return $distributors[$i];
//            }
//            if($id === $distributors[$i]) {
//                return $distributors[$i+1];
//            }
////            if ($id === 4828) {
////                return 4830;
////            }
////            if ($id === 4830) {
////                return 82;
////            }
//        }
        } else {
            throw new RouteNotFoundException("Route not defined.");
        }
    }

    public function queryByFilter($attributes): Builder
    {
        $query = parent::query();
        //dd('asd');
        if (array_key_exists('iin', $attributes)) {
//            $query = $query->join('profiles', 'appeals.user_id', '=', 'profiles.user_id')
//                           ->where('iin', 'like', '%' . $attributes[ 'iin' ] . '%')
//            ;
//            $query = $query->leftJoin('business', 'business_id', '=', 'id')
//                ->leftJoin('organization', 'business.organization_id', '=', 'organization.id')
//                ->where('iin', 'like', '%' . $attributes[ 'iin' ] . '%')
//            ;
            if (Auth::user()->hasRole(RoleEnum::Distributor)) {
                $query = $query->select('appeals.*', 'organizations')->where('appeals.distributor_id', Auth::user()->id)
                    ->leftJoin('businesses', 'business_id', '=', 'businesses.id')
                    ->leftJoin('organizations', 'businesses.organization_id', '=', 'organizations.id')
                    ->where('organizations.iin', 'like', '%' . $attributes[ 'iin' ] . '%')
                ;
            }else {
                $query = $query->select('appeals.*', 'organizations')
                    ->leftJoin('businesses', 'business_id', '=', 'businesses.id')
                    ->leftJoin('organizations', 'businesses.organization_id', '=', 'organizations.id')
                    ->where('organizations.iin', 'like', '%' . $attributes[ 'iin' ] . '%')
                ;
            }
        }

        // if (array_key_exists('from_date', $attributes)) {
        //     $query = $query->where('createDate', '>=', $attributes[ 'from_date' ]);
        // }

        // if (array_key_exists('to_date', $attributes)) {
        //     $query = $query->where('createDate', '<=', $attributes[ 'to_date' ]);
        // }

        if (array_key_exists('category_id', $attributes)) {
            if(is_array($attributes['category_id'])) {
                $query = $query->whereIn('category_id', $attributes['category_id']);
            } elseif(is_string('category_id')) {
                $category_id = explode(',', $attributes['category_id']);
                $query = $query->whereIn('category_id', $category_id);
            }
        }

        if (array_key_exists('type_id', $attributes)) {
            $query = $query->where('type_id', $attributes[ 'type_id' ]);
        }

        if (array_key_exists('executor_id', $attributes)) {
            $query = $query->where('last_executor_id', $attributes[ 'executor_id' ]);
        }

        if (array_key_exists('district_id', $attributes)) {
            $query = $query->where('district_id', $attributes[ 'district_id' ]);
        }

        if (array_key_exists('co_executor_id', $attributes)) {
            $query = $query->where('last_coexecutor_id', $attributes[ 'co_executor_id' ]);
        }

        if (array_key_exists('distributor_id', $attributes)) {
            $query = $query->where('distributor_id', $attributes[ 'distributor_id' ]);
        }

        if (array_key_exists('last_curator_upi_id', $attributes)) {
            $query = $query->where('last_curator_upi_id', $attributes[ 'last_curator_upi_id' ]);
        }

        if (array_key_exists('last_curator_district_id', $attributes)) {
            $query = $query->where('last_curator_district_id', $attributes[ 'last_curator_district_id' ]);
        }
        if (array_key_exists('appeal_result_type_id', $attributes)) {
            $query = $query->where('appeal_result_type_id', $attributes[ 'appeal_result_type_id' ]);
        }

        if (array_key_exists('appeal_status_id', $attributes)) {
//            if (Auth::user()->hasRole(RoleEnum::Head)) {
//                $query = $query->where('client_appeal_status_id', $attributes[ 'appeal_status_id' ]);
//            } else {
                $query = $query->where('appeal_status_id', $attributes[ 'appeal_status_id' ]);
//            }
        }
        if (array_key_exists('client_appeal_status_id', $attributes)) {
//            if (Auth::user()->hasRole(RoleEnum::Head)) {
//                $query = $query->where('client_appeal_status_id', $attributes[ 'appeal_status_id' ]);
//            } else {
            $query = $query->where('client_appeal_status_id', $attributes[ 'client_appeal_status_id' ]);
//            }
        }

        if (array_key_exists('client_appeal_status_id', $attributes)) {
            $query = $query->where('client_appeal_status_id', $attributes[ 'client_appeal_status_id' ]);
        }

        if (array_key_exists('source_type_id', $attributes)) {
            $query = $query->where('source_type_id', $attributes[ 'source_type_id' ]);
        }

        if (array_key_exists('isIn_Upi', $attributes)) {
            if ($attributes[ 'isIn_Upi' ] == '1') {
                $query = $query->where('flow_type_id', FlowTypeEnum::Upi);
            } else {
                $query = $query->where(
                    function ($query)
                    {
                        $query->where('flow_type_id', '<>', FlowTypeEnum::Upi)
                              ->orWhereNull('flow_type_id')
                        ;
                    }
                );
            }
        }

        if (array_key_exists('start_date', $attributes)) {
            $query = $query->where('createDate', '>=', $attributes[ 'start_date' ]);
        }

        if (array_key_exists('end_date', $attributes)) {
            $query = $query->where('createDate', '<=', $attributes[ 'end_date' ]);
        }
        if (array_key_exists('start_date_updated', $attributes)) {
            $query = $query->where('updated_at', '>=', $attributes[ 'start_date_updated' ]);
        }

        if (array_key_exists('end_date_updated', $attributes)) {
            $query = $query->where('updated_at', '<=', $attributes[ 'end_date_updated' ]);
        }
        
        $query->where(function($query){
            $query
            ->where('category_id','!=','b9f28fb2-3e63-4c10-a7e2-e99fbd4b3d67')->where('category_id','!=','6b82561d-48a3-43ca-9965-86b43491a03d');
        });

        return $query;
    }

    public function attachManagerDocuments($id, $attributes): ?Model
    {
        DB::beginTransaction();

        try {
            $entity = null;
            if (array_key_exists('file', $attributes)) {
                foreach ($attributes[ 'file' ] as $file) {
                    $entity = $this->appealDocumentRepository->createManagerDocument($id, $file);
                }
            }

            DB::commit();

            return $entity;

        } catch (Exception $ex) {
            DB::rollback();
            throw $ex;
        }

    }

    public function getNextClientNumber(int $client_id): string
    {
        $startDate = Carbon
            ::now()
            ->setMonth(1)
            ->setDay(1)
            ->setTime(0, 0, 0, 0)
        ;
        $endDate   = Carbon
            ::now()
            ->setMonth(12)
            ->setTime(23, 59, 59)
        ;
        $endDate->setDay($endDate->daysInMonth);

        $last = $this->model
                    ->whereBetween('createDate', [ $startDate, $endDate ])
                    ->where('client_appeal_status_id', '!=', ClientAppealStatusEnum::Draft)
                    ->where('user_id', $client_id)
                    ->whereNotNull('appeal_no')
                    ->count() + 1;

        $number = $startDate->format('Y')
                  . '/'
                  . Str::padLeft($client_id, 6, '0')
                  . '/'
                  . Str::padLeft($last, 4, '0');

        return $number;
    }


    public function getDataForSendingEmailManager()
    {
        $date = Carbon::now()
                      ->setTime(0, 0, 0, 0)
                      ->addDays(-1)
        ;
        return parent::query()
                     ->leftJoin('users', 'appeals.user_id', '=', 'users.id')
                     ->leftJoin('profiles', 'profiles.user_id', '=', 'users.id')
                     ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                     ->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                     ->leftJoin('businesses', 'businesses.id', '=', 'appeals.business_id')
                     ->leftJoin('organizations', 'organizations.id', '=', 'businesses.organization_id')
                     ->leftJoin('service_groups', 'service_groups.id', '=', 'appeals.category_id')
            //                     ->where('roles.id',  RoleIntEnum::Manager)
                     ->whereIn('appeals.source_type_id', [ SourceTypeEnum::MIO, SourceTypeEnum::CALL_CENTER ])
                     ->where('appeals.created_at', '>=', $date)
                     ->get(
                         [
                             'users.email',
                             'appeals.id',
                             'organizations.name as organizations_name',
                             'organizations.iin',
                             'service_groups.name as category_name',
                             'profiles.last_name',
                             'profiles.first_name',
                             'profiles.second_name',
                         ]
                     )
            ;
    }

    public function getNewAppealsForEmail($period)
    {
        return parent::query()
                     ->leftJoin('users', 'appeals.distributor_id', '=', 'users.id')
                     ->leftJoin('profiles', 'profiles.user_id', '=', 'users.id')
                     ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                     ->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                     ->leftJoin('businesses', 'businesses.id', '=', 'appeals.business_id')
                     ->leftJoin('organizations', 'organizations.id', '=', 'businesses.organization_id')
                     ->leftJoin('service_groups', 'service_groups.id', '=', 'appeals.category_id')
            //        ->where('roles.id',  RoleIntEnum::Manager)
            //        ->where('appeals.appeal_status_id',  AppealStatusEnum::DistributorAssigned)
                     ->where('appeals.created_at', '>=', $period)
                     ->get(
                         [
                             'users.email',
                             'appeals.id',
                             'organizations.name as organizations_name',
                             'organizations.iin',
                             'service_groups.name as category_name',
                             'profiles.last_name',
                             'profiles.first_name',
                             'profiles.second_name',
                         ]
                     )
            ;
    }


    public function getAppealsForApprove($period)
    {
        return parent::query()
                     ->leftJoin('users', 'appeals.user_id', '=', 'users.id')
                     ->leftJoin('profiles', 'profiles.user_id', '=', 'users.id')
                     ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                     ->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
                     ->leftJoin('businesses', 'businesses.id', '=', 'appeals.business_id')
                     ->leftJoin('organizations', 'organizations.id', '=', 'businesses.organization_id')
                     ->leftJoin('service_groups', 'service_groups.id', '=', 'appeals.category_id')
            //        ->where('roles.id',  RoleIntEnum::Manager)
                     ->whereIn(
                'appeals.appeal_status_id',
                [ AppealStatusEnum::DistrictCuratorConfirm, AppealStatusEnum::DivisionCuratorConfirm ]
            )
                     ->where('appeals.created_at', '>=', $period)
                     ->get(
                         [
                             'users.email',
                             'appeals.id',
                             'organizations.name as organizations_name',
                             'organizations.iin',
                             'service_groups.name as category_name',
                             'profiles.last_name',
                             'profiles.first_name',
                             'profiles.second_name',
                         ]
                     )
            ;
    }
}

<?php

namespace App\Repositories;

use App\Integration\IMioBusinessStatuses;
use App\Models\Appeal;
use App\Models\AppealHistory;
use App\Models\AppealQoldayProduct;
use App\Models\AppealReferenceHistory;
use App\Models\Business;
use App\Models\Profile;
use App\Models\User;
use App\Repositories\Enums\AppealActionTypeEnum;
use App\Repositories\Enums\AppealStatusEnum;
use App\Repositories\Enums\AppealResultTypeEnum;
use App\Repositories\Enums\ClientAppealStatusEnum;
use App\Repositories\Enums\FlowTypeEnum;
use App\Repositories\Enums\RoleIntEnum;
use App\Repositories\Enums\SourceTypeEnum;
use App\Repositories\Support\AutoAssignDistributorTrait;
use App\Repositories\Support\IAutoAssignDistributor;
use App\Services\Camunda\CamundaService;
use App\Services\Camunda\ICamundaService;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AppealForDistributorRepository extends AppealRepository
    implements IAppealForDistributorRepository, IAutoAssignDistributor
{
    use AutoAssignDistributorTrait;

    private $appealExecutorRepository;
    private $appealCoExecutorRepository;
    private ICamundaService $camundaService;

    public function __construct(
        Appeal $model,
        AppealHistory $historyModel,
        IAppealExecutorRepository $appealExecutorRepository,
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
        $this->appealExecutorRepository   = $appealExecutorRepository;
        $this->appealCoExecutorRepository = $appealCoExecutorRepository;
        $this->camundaService = $camundaService;
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
        if (array_key_exists('iin', $attributes)) {
            $query = $query
                ->where('client_appeal_status_id', '!=', ClientAppealStatusEnum::Draft)
                ->where('appeals.distributor_id', Auth::user()->id)
                ->orderByDesc('createDate')
            ;
        } else {
            $query = $query
                ->where('client_appeal_status_id', '!=', ClientAppealStatusEnum::Draft)
                ->where('distributor_id', Auth::user()->id)
                ->orderByDesc('createDate')
            ;
        }
        $query->where(function($query){
            $query
            ->where('category_id','!=','b9f28fb2-3e63-4c10-a7e2-e99fbd4b3d67')->orWhere('category_id','!=','6b82561d-48a3-43ca-9965-86b43491a03d');
        });
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
        if (array_key_exists('iin', $attributes)) {
            $query = $query
                ->where('client_appeal_status_id', '!=', ClientAppealStatusEnum::Draft)
                ->where('appeals.distributor_id', Auth::user()->id)
                ->orderByDesc('createDate')
            ;
        } else {
            $query = $query
                ->where('client_appeal_status_id', '!=', ClientAppealStatusEnum::Draft)
                ->where('distributor_id', Auth::user()->id)
                ->orderByDesc('createDate')
            ;
        }

        $query = $this->filterByStatus($query, $attributes);

        $perPage = null;
        if (array_key_exists('per_page', $attributes)) {
            $perPage = $attributes[ 'per_page' ];
        }

        return is_null($perPage)
            ? $query->get()
            : $query->paginate($perPage);
    }

    public function getToWork($id): ?Model
    {
        return $this->assignDistributor($id, Auth::user()->id);
    }

    public function assignExecutor($id, $attributes): ?Model
    {
        DB::beginTransaction();

        try {
            $entity = parent::update(
                $id,
                [
                    'comment'                 => array_key_exists('comment', $attributes)
                        ? $attributes[ 'comment' ]
                        : null,
                    'appeal_status_id'        => AppealStatusEnum::ExecutorAssigned,
                    'client_appeal_status_id' => ClientAppealStatusEnum::InWork,
                    'district_id'             => $attributes[ 'district_id' ],
                    'last_action_type_id'     => AppealActionTypeEnum::ExecutorAssigned,
                    'last_executor_id'        => $attributes[ 'executor_id' ],
                    'industry_id'             => $attributes[ 'industry_id' ],
                    'flow_type_id'            => FlowTypeEnum::Qoldau,
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
                    'flow_type_id'        => FlowTypeEnum::Qoldau,
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
        $entity = parent::update(
            $id,
            [
                'appeal_status_id'        => AppealStatusEnum::Completed,
                'client_appeal_status_id' => AppealStatusEnum::Completed,
                'comment'                 => array_key_exists('comment', $attributes)
                    ? $attributes[ 'comment' ]
                    : null,
                'last_action_type_id'     => AppealActionTypeEnum::Completed,
                'appeal_result_type_id'   => array_key_exists('appeal_result_type_id', $attributes)
                    ?
                    $attributes[ 'appeal_result_type_id' ]
                    : null,
                'files'                   => $attributes[ 'files' ] ?? [],
            ]
        );

        $this->camundaService->completedByDistributor($id, Auth::user()->id, Auth::user()->profile->full_name);

        return $entity;
    }

    public function reject($id, $attributes): ?Model
    {
        $entity = parent::update(
            $id,
            [
                'appeal_status_id'        => AppealStatusEnum::Rejected,
                'client_appeal_status_id' => ClientAppealStatusEnum::Rejected,
                'comment'                 => $attributes[ 'comment' ],
                'last_action_type_id'     => AppealActionTypeEnum::Rejected,
                'appeal_result_type_id'   => array_key_exists('appeal_result_type_id', $attributes)
                    ? $attributes[ 'appeal_result_type_id' ]
                    : null,
                'files'                   => $attributes[ 'files' ] ?? [],
            ]
        );

        $this->camundaService->completedByDistributor($id, Auth::user()->id, Auth::user()->profile->full_name);

        return $entity;
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

    public function cantContact($id): ?Model
    {
        DB::beginTransaction();


        try {
            $entity = parent::find($id);
            $appealHistory = AppealHistory::query()
                ->where('appeal_id', $id)
                ->orderByDesc('created_at')
                ->first()
            ;
            $count = $appealHistory->action_type_count+1;
            $appealHistory->action_type_count = $count;
            $appealHistory->save();
            if($appealHistory->action_type_count === 3) {
                $entity = parent::update(
                    $id,
                    [
                        'appeal_result_type_id' => AppealResultTypeEnum::RequiresClarification,
                        'appeal_status_id' => AppealStatusEnum::requiresClarification,
                        'client_appeal_status_id' => ClientAppealStatusEnum::Completed,
                        'last_action_type_id' => AppealActionTypeEnum::Returned,
                    ]
                );
            } else if ($appealHistory->action_type_count < 3) {
                $entity = parent::update(
                    $id,
                    [
                        'appeal_status_id' => AppealStatusEnum::CantContact,
                        'last_action_type_id' => AppealActionTypeEnum::CantContact,
                    ]
                );
            }

            DB::commit();

            return $entity;

        } catch (Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }

    public function byProduct($request, $id): ?Model
    {
        DB::beginTransaction();

        try {
            $entity = parent::find($id);
            $appealHistory = AppealHistory::query()
                ->where('appeal_id', $id)
                ->orderByDesc('created_at')
                ->first();
            $appealHistory->client_appeal_status_id = AppealStatusEnum::Completed;
            $appealHistory->appeal_status_id = AppealStatusEnum::adviceByProduct;
            $appealHistory->comment = $request->comment ?? null;
            $appealHistory->save();

            $qProd = new AppealQoldayProduct;
            $qProd->appeal_id = $id;
            $qProd->category_id = $request->byQoldayProduct['id'];
            $qProd->comment = $request->comment ?? null;
            $qProd->save();

            $entity = parent::update(
                $id,
                [
                    'appeal_result_type_id' => AppealResultTypeEnum::ByQolday,
                    'client_appeal_status_id' => AppealStatusEnum::Completed,
                    'appeal_status_id' => AppealStatusEnum::adviceByProduct,
                    'category_id' => $request->byQoldayProduct['id'] ?? null
                ]
            );

            DB::commit();

            return $entity;

        } catch (Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }

    public function notByProduct($request, $id): ?Model
    {
        DB::beginTransaction();


        try {
            $entity = parent::find($id);
            $appealHistory = AppealHistory::query()
                ->where('appeal_id', $id)
                ->orderByDesc('created_at')
                ->first();

            $appealHistory->client_appeal_status_id = AppealStatusEnum::Completed;
            $appealHistory->appeal_status_id = AppealStatusEnum::advicebNotByProduct;
            $appealHistory->save();

            $qProd = new AppealQoldayProduct;
            $qProd->appeal_id = $id;
            $qProd->comment = $request->comment;
            $qProd->save();

            $entity = parent::update(
                $id,
                [
                    'appeal_result_type_id' => AppealResultTypeEnum::NotByQolday,
                    'client_appeal_status_id' => AppealStatusEnum::Completed,
                    'appeal_status_id' => AppealStatusEnum::advicebNotByProduct,
                    'last_action_type_id' => AppealStatusEnum::advicebNotByProduct,
                ]
            );

            DB::commit();

            return $entity;

        } catch (Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }

    public function requiresClarification($request, $id): ?Model
    {
        DB::beginTransaction();


        try {
            $entity = parent::find($id);
            $appealHistory = AppealHistory::query()
                ->where('appeal_id', $id)
                ->orderByDesc('created_at')
                ->first();

            $appealHistory->client_appeal_status_id = AppealStatusEnum::Completed;
            $appealHistory->appeal_status_id = AppealStatusEnum::requiresClarification;
            $appealHistory->save();

            $qProd = new AppealQoldayProduct;
            $qProd->appeal_id = $id;
            $qProd->comment = $request->comment;
            $qProd->save();

            $entity = parent::update(
                $id,
                [
                    'appeal_result_type_id' => AppealResultTypeEnum::RequiresClarification,
                    'client_appeal_status_id' => AppealStatusEnum::Completed,
                    'appeal_status_id' => AppealStatusEnum::requiresClarification,
                ]
            );

            DB::commit();

            return $entity;

        } catch (Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }

    public function assignCurator($id, $attributes): ?Model
    {
        DB::beginTransaction();

        try {
            $entity = parent::update(
                $id,
                [
                    'appeal_status_id'         => AppealStatusEnum::CuratorAssigned,
                    'district_id'              => $attributes[ 'district_id' ],
                    'last_action_type_id'      => AppealActionTypeEnum::CuratorAssigned,
                    'last_curator_upi_id'      => $attributes[ 'curator_upi_id' ],
                    'last_curator_district_id' => $attributes[ 'curator_district_id' ],
                    'industry_id'              => $attributes[ 'industry_id' ],
                    'flow_type_id'             => FlowTypeEnum::Upi,
                    'comment'                  => array_key_exists('comment', $attributes)
                        ? $attributes[ 'comment' ]
                        : null,
                ]
            );

            //            $this->appealCoExecutorRepository->assign($entity->id, $attributes['co_executor_id']);

            DB::commit();

            return $entity;

        } catch (Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }
    private function assignDistributorTest($appealId, $userId): ?Model
    {
        parent::update(
            $appealId,
            [
                'distributor_id'          => $userId,

                'appeal_status_id'        => AppealStatusEnum::InWork,
                'client_appeal_status_id' => ClientAppealStatusEnum::InWork,
                'last_action_type_id'     => AppealActionTypeEnum::DistributorAssigned,
            ]
        );
        return parent::find($appealId);
    }
    private function assignDistributor($appealId, $userId): ?Model
    {
        parent::update(
            $appealId,
            [
                'distributor_id'          => $userId,
                'last_action_type_id'     => AppealActionTypeEnum::DistributorAssigned,
            ]
        );

        return parent::find($appealId);
    }

    public function autoAssignDistributor($id): ?Model
    {
        $appeal = $this->find($id);
        if($appeal->category_id == 'b9f28fb2-3e63-4c10-a7e2-e99fbd4b3d67' || $appeal->category_id == '6b82561d-48a3-43ca-9965-86b43491a03d'){
            $user = Profile::where('department_id','=','3d59bef0-9a4f-45a6-8e86-292a76a258a4')->first();
            $appeal = $this->assignDistributor($id, $user->user_id);
        } else {

            if (
                $appeal
                && $appeal->business
                && $appeal->business->distributor_id
            ) {
                $nextDistributor = User::find($appeal->business->distributor_id);

                if ($nextDistributor) {
                    $nextDistributor->profile->update(
                        [
                            'last_assignment_date' => new \DateTime("now", new \DateTimeZone("UTC")),
                        ]
                    );
                }
            } else {
                $nextDistributor = $this->getNextDistributorForAutoAssignment();
            }

            $appeal = $this->assignDistributor($id, optional($nextDistributor)->id);
        }
        
        return $appeal;
    }

    public function createAppealByParent(string $parent_id, $attributes): Model
    {
        DB::beginTransaction();

        try {
            $parentAppeal = Appeal::findOrFail($parent_id);

            $attributes = array_merge(
                $attributes,
                [
                    'user_id'                 => $parentAppeal->user_id,
                    'distributor_id'          => $parentAppeal->distributor_id,
                    'business_id'             => $parentAppeal->business_id,
                    'client_appeal_status_id' => ClientAppealStatusEnum::InWork,
                    'appeal_status_id'        => AppealStatusEnum::Pending,
                    'source_type_id'          => SourceTypeEnum::Portal,
                ]
            );

            $attributes = array_filter($attributes);

            $entity = parent::create($attributes);

            $this->camundaService->startProcess($entity->id);

            AppealReferenceHistory::create(
                [
                    'appeal_id'        => $entity->id,
                    'parent_appeal_id' => $parentAppeal->id,
                    'distributor_id'   => $parentAppeal->distributor_id,
                ]
            );

            DB::commit();

            return $entity;
        } catch (Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }

    public function createAppealByBusiness(string $business_id, $attributes): Model
    {
        DB::beginTransaction();

        try {
            $business   = Business::findOrFail($business_id);
            $attributes = array_merge(
                $attributes,
                [
                    'user_id'                 => $business->organization->profile->user->id,
                    'distributor_id'          => $business->distributor_id ?? Auth::user()->id,
                    'business_id'             => $business->id,
                    'client_appeal_status_id' => ClientAppealStatusEnum::InWork,
                    'appeal_status_id'        => AppealStatusEnum::Pending,
                    'source_type_id'          => SourceTypeEnum::Portal,
                ]
            );

            $attributes = array_filter($attributes);

            $entity = parent::create($attributes);

            DB::commit();

            return $entity;
        } catch (Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }

    private function filterByStatus($query, $attributes)
    {
        if (array_key_exists('appeal_status', $attributes)) {
            $appealStatus = $attributes[ 'appeal_status' ];
            switch ($appealStatus) {
                case 'distributor_assigned':
                {
                    $query = $query
                        ->where('appeal_status_id', [ AppealStatusEnum::DistributorAssigned ]);
                    break;
                }
                case 'in_work':
                {
                    $query = $query
                        ->whereNotIn(
                            'appeal_status_id',
                            [
                                AppealStatusEnum::DistributorAssigned,
                                AppealStatusEnum::Completed,
                                AppealStatusEnum::Rejected,
                            ]
                        );
                    break;
                }
                case 'completed':
                {
                    $query = $query
                        ->whereIn('appeal_status_id', [ AppealStatusEnum::Completed, AppealStatusEnum::Rejected ]);
                    break;
                }
                case 'confirmation':
                {
                    $query = $query
                        ->where('appeal_status_id', [ AppealStatusEnum::DivisionCuratorConfirm ]);
                    break;
                }
            }
            if ($appealStatus === 'business.correction') {
                $query = $query->whereHas(
                    'business',
                    function ($q)
                    {
                        $q->where('status', IMioBusinessStatuses::UPDATE_REQUIRED);
                    }
                );
            } else {
                $query = $query->where(
                    function ($query)
                    {
                        $query
                            ->whereHas(
                                'business',
                                function ($q)
                                {
                                    $q->where('status', '!=', IMioBusinessStatuses::UPDATE_REQUIRED);
                                }
                            )
                            ->orWhereDoesntHave('business')
                        ;
                    }
                );
            }
        }

        return $query;
    }

}

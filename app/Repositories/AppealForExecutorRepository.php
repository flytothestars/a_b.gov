<?php

namespace App\Repositories;

use App\Models\Appeal;
use App\Models\AppealHistory;
use App\Models\AppealQoldayProduct;
use App\Repositories\Enums\AppealActionTypeEnum;
use App\Repositories\Enums\AppealResultTypeEnum;
use App\Repositories\Enums\AppealStatusEnum;
use App\Repositories\Enums\ClientAppealStatusEnum;
use App\Services\Camunda\ICamundaService;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppealForExecutorRepository extends AppealRepository implements IAppealForExecutorRepository
{
    private $appealExecutorRepository;
    private $appealCoExecutorRepository;

    public function __construct(
        Appeal $model,
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
    }

    public function find($id): ?Model
    {
        return parent::query()
                    ->where('client_appeal_status_id', '!=', ClientAppealStatusEnum::Draft)
                     ->where('appeal_status_id', '!=', AppealStatusEnum::DistributorAssigned)
                     ->where('id', '=', $id)
                     ->first()
            ;
    }

    public function findAppealsByAuthUser($attributes)
    {
        $query = $this->queryByFilter($attributes);

        $query = $query
            ->where('client_appeal_status_id', '!=', ClientAppealStatusEnum::Draft)
            ->where('appeal_status_id', '!=', AppealStatusEnum::DistributorAssigned)
//            ->where('last_executor_id', Auth::user()->id)
            ->orderByDesc('createDate')
        ;

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

        $query = $query
            ->where('client_appeal_status_id', '!=', ClientAppealStatusEnum::Draft)
            ->where('appeal_status_id', '!=', AppealStatusEnum::DistributorAssigned)
            ->orderByDesc('createDate')
        ;

        if(array_key_exists('appeal_status', $attributes)){
            $appealStatus = $attributes[ 'appeal_status' ];
            switch ($appealStatus){
                case 'in_work':{
                    $query = $query
                        ->whereNotIn('appeal_status_id', [AppealStatusEnum::Completed, AppealStatusEnum::Rejected]);;
                    break;
                }
                case 'completed':{
                    $query = $query
                        ->whereIn('appeal_status_id', [AppealStatusEnum::Completed, AppealStatusEnum::Rejected]);
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

    public function getToWork($id): ?Model
    {
        DB::beginTransaction();

        try {
            $entity = parent::update(
                $id,
                [
                    'last_action_type_id' => AppealActionTypeEnum::ExecutorAssigned,
                    'last_executor_id'    => Auth::user()->id,
                ]
            );

            $this->appealExecutorRepository->assign($entity->id, Auth::user()->id);

            DB::commit();

            return parent::find($id);

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
                'appeal_status_id'    => AppealStatusEnum::Confirmed,
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
}

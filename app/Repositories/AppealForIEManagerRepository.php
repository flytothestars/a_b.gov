<?php

namespace App\Repositories;

use App\Models\Appeal;
use App\Models\Profile;
use App\Repositories\Enums\AppealStatusEnum;
use App\Repositories\Enums\ClientAppealStatusEnum;
use App\Services\Camunda\ICamundaService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Enums\RoleEnum;
use Illuminate\Support\Facades\DB;
class AppealForIEManagerRepository extends AppealRepository
    implements IAppealForIEManagerRepository
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
        $query = parent::query();
        
        /**
         * Draft Appeals Ignore
         */
        $query = $query
            ->where('client_appeal_status_id', '!=', ClientAppealStatusEnum::Draft)
            ->orderByDesc('createDate');
        
        /**
         *  Filter status, category, iin, create date
         */
        if (array_key_exists('iin', $attributes)) {
            $profile = Profile::where('iin','like', '%' . $attributes[ 'iin' ] . '%')->first();
            if($profile){
                $query = $query->select('appeals.*', 'organizations')
                ->leftJoin('businesses', 'business_id', '=', 'businesses.id')
                ->leftJoin('organizations', 'businesses.organization_id', '=', 'organizations.id')
                ->where('appeals.user_id','=', $profile->user_id);
            }else{
                $query = $query->select('appeals.*', 'organizations')
                ->leftJoin('businesses', 'business_id', '=', 'businesses.id')
                ->leftJoin('organizations', 'businesses.organization_id', '=', 'organizations.id')
                ->where('organizations.iin', 'like', '%' . $attributes[ 'iin' ] . '%');
            }
        }

        if (array_key_exists('client_appeal_status_id', $attributes)) {
            $query = $query->where('client_appeal_status_id','=', $attributes[ 'client_appeal_status_id' ]);
        }
        
        if (array_key_exists('category_id', $attributes)) {
            if(is_array($attributes['category_id'])) {
                $query = $query->whereIn('category_id', $attributes['category_id']);
            } elseif(is_string('category_id')) {
                $category_id = explode(',', $attributes['category_id']);
                $query = $query->whereIn('category_id', $category_id);
            }
        }
        if (array_key_exists('start_date', $attributes)) {
            $query = $query->where('created_at', '>=', $attributes[ 'start_date' ]);
        }

        if (array_key_exists('end_date', $attributes)) {
            $query = $query->where('created_at', '<=', $attributes[ 'end_date' ]);
        }
        $query->where(function($query){
            $query
            ->where('category_id','=','b9f28fb2-3e63-4c10-a7e2-e99fbd4b3d67')->orWhere('category_id','=','6b82561d-48a3-43ca-9965-86b43491a03d');
        });
        //=============================


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

    public function ieAccessAppeals($request, $id)
    {
        DB::beginTransaction();

        try {
            $appeal = parent::find($id);
            $appeal = parent::update(
                $id,
                [
                    'client_appeal_status_id' => AppealStatusEnum::Completed,
                    'comment' => $request->comment ?? null
                ]
            );
            DB::commit();

            return $appeal;

        } catch (Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }

    public function ieRejectAppeals($request, $id)
    {
        DB::beginTransaction();

        try {
            $appeal = parent::find($id);
            $appeal = parent::update(
                $id,
                [
                    'client_appeal_status_id' => AppealStatusEnum::Rejected,
                    'comment' => $request->comment ?? null
                ]
            );       

            DB::commit();

            return $appeal;

        } catch (Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }

}

<?php


namespace App\Repositories;

use App\Models\Appeal;
use App\Models\AppealHistory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class AppealHistoryRepository extends BaseRepository implements IAppealHistoryRepository
{
    public function __construct(AppealHistory $model)
    {
        parent::__construct($model);
    }

    public function createByAppeal(Model $appeal): ?Model
    {
        return parent::create([
            'appeal_id' => $appeal->id,
            'comment' => $appeal->comment,
            'appeal_status_id' => $appeal->appeal_status_id,
            'client_appeal_status_id' => $appeal->client_appeal_status_id,
            'created_by' => optional(Auth::user())->id,
            'appeal_action_type_id' => $appeal->last_action_type_id,
            'distributor_id' => $appeal->distributor_id,
            'executor_id' => $appeal->last_executor_id,
            'coexecutor_id' => $appeal->last_coexecutor_id,
            'appeal_result_type_id' => $appeal->appeal_result_type_id,
            'curator_upi_id' => $appeal->last_curator_upi_id,
            'curator_district_id' => $appeal->last_curator_district_id,
        ]);
    }

    public function getByAppeal($appealId): Collection
    {
        return parent::query()
            ->where('appeal_id','=', $appealId)
            ->get();
    }

    public function firstByAppeal($appealId): ?Model
    {
        return parent::query()
            ->where('appeal_id','=', $appealId)
            ->first();
    }

    public function getByAppealAll($appealId): Collection
    {
        $appeal = Appeal::query()
            ->where('id', $appealId)
            ->orderByDesc('created_at')
            ->first()
        ;
        $appealAll = Appeal::query()
            ->where('business_id', $appeal->business_id)
            ->where('client_appeal_status_id', '9454eb49-44c5-4c12-8316-a9650f203a8a')
            ->get()
        ;
        foreach($appealAll as $all) {
            $id[] = $all->id;
        }
        return parent::query()
            ->whereIn('appeal_id', $id)
            ->get();
    }
}

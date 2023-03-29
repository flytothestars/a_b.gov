<?php


namespace App\Repositories;


use App\Models\Appeal;
use App\Models\AppealResultMatrix;
use App\Models\AppealResultType;
use App\Repositories\Enums\AppealStatusEnum;
use App\Repositories\Enums\FlowTypeEnum;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class AppealResultTypeRepository extends BaseRepository implements IAppealResultTypeRepository
{
    public function __construct(AppealResultType $model)
    {
        parent::__construct($model);
    }

    public function allByAppealAndToStatus($appealId, $toAppealStatus): ?Collection
    {
        $appeal = Appeal::query()
            ->where('id', $appealId)
            ->first();

        if(!$appeal)
            return null;

        /** @noinspection PhpUndefinedFieldInspection */
        $userRoles = Auth::user()->roles->pluck('id');

        $appealResultTypeIds = AppealResultMatrix::query()
//            ->where('from_appeal_status_id', $appeal->appeal_status_id)
            ->where('from_appeal_status_id', AppealStatusEnum::InWork)
            ->where('to_appeal_status_id', $toAppealStatus)
            ->whereIn('role_id', $userRoles)
            ->where('is_active', true)
            ->where('flow_type_id', $appeal->flow_type_id ?? FlowTypeEnum::Qoldau)
            ->get('appeal_result_type_id');

        return parent::query()->whereIn('id', $appealResultTypeIds->toArray())->get();
    }
}

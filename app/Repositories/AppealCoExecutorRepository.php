<?php


namespace App\Repositories;


use App\Models\AppealsCoExecutor;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class AppealCoExecutorRepository extends BaseRepository implements IAppealCoExecutorRepository
{
    public function __construct(AppealsCoExecutor $model)
    {
        parent::__construct($model);
    }

    public function assign($appeal_id, $co_executor_id): ?Model
    {
        $activeAppealCoExecutor = parent::query()->where('appeals_id','=', $appeal_id)
            ->where('is_active', '=', true)
            ->first();

        if($activeAppealCoExecutor){
            parent::update($activeAppealCoExecutor->id,[
                'is_active' => false
            ]);
        }

        return parent::create([
            'id' => Uuid::uuid4(),
            'appeals_id' => $appeal_id,
            'coexecutor_id' => $co_executor_id,
            'is_active' => true
        ]);
    }
}

<?php


namespace App\Repositories;


use App\Models\AppealsExecutor;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class AppealExecutorRepository extends BaseRepository implements IAppealExecutorRepository
{
    public function __construct(AppealsExecutor $model)
    {
        parent::__construct($model);
    }

    public function assign($appeal_id, $executor_id): ?Model
    {
        $activeAppealExecutor = parent::query()->where('appeals_id','=', $appeal_id)
            ->where('is_active', '=', true)
            ->first();

        if($activeAppealExecutor){
            parent::update($activeAppealExecutor->id,[
                'is_active' => false
            ]);
        }

        return parent::create([
            'id' => Uuid::uuid4(),
            'appeals_id' => $appeal_id,
            'executor_id' => $executor_id,
            'is_active' => true
        ]);
    }
}

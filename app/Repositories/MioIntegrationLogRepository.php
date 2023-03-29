<?php


namespace App\Repositories;


use App\Models\MioIntegrationLog;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class MioIntegrationLogRepository extends BaseRepository implements IMioIntegrationLogRepository
{
    public function __construct(MioIntegrationLog $model)
    {
        parent::__construct($model);
    }

    public function start(array $attributes): Model
    {
        return parent::create(
            [
                'id' => Uuid::uuid4(),
                'started_at' => new \DateTime("now", new \DateTimeZone("UTC"))
            ]
        );
    }

    public function success($id, $rowCount): Model
    {
        return parent::update($id,
            [
                'completed_at' => new \DateTime("now", new \DateTimeZone("UTC")),
                'rows_processed' => $rowCount,
                'is_success' => true,
            ]
        );
    }

    public function fail($id, $description): Model
    {
        return parent::update($id,
            [
                'completed_at' => new \DateTime("now", new \DateTimeZone("UTC")),
                'is_success' => false,
                'error_description' => $description
            ]
        );
    }

    public function lastSuccessed(): Model
    {
        return parent::query()->where('is_success', true)->latest('completed_at')->first();
    }
}

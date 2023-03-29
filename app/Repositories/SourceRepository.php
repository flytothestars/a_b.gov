<?php


namespace App\Repositories;


use App\Models\AppealsCoExecutor;
use App\Models\AppealSourceType;
use App\Models\AppealStatus;
use App\Models\SourceType;
use App\Repositories\Enums\AppealStatusEnum;
use App\Repositories\Enums\ClientAppealStatusEnum;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class SourceRepository extends BaseRepository implements ISourceRepository
{
    public function __construct(SourceType $model)
    {
        parent::__construct($model);
    }
}

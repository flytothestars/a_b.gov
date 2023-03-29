<?php


namespace App\Repositories;


use App\Models\AppealsCoExecutor;
use App\Models\AppealStatus;
use App\Repositories\Enums\AppealStatusEnum;
use App\Repositories\Enums\ClientAppealStatusEnum;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AppealStatusRepository extends BaseRepository implements IAppealStatusRepository
{
    public function __construct(AppealStatus $model)
    {
        parent::__construct($model);
    }

    public function getAppealStatuesForClient()
    {
        $appeal_status = parent::all();
        $arr = [
            '9454eb49-44c5-4c12-8316-a9650f203a8a',
            'f9840d9f-d405-4c17-9789-8d34b082ad06',
            '21cbcd3d-b6b4-48f4-abbf-4929dde31706',
        ];

        return $appeal_status->filter(function($item, $key) use ($arr) {
            if (in_array($item->id, $arr)){
                return $item;
            }
        });
    }
}

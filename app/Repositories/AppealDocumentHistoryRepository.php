<?php


namespace App\Repositories;


use App\Models\AppealDocument;
use App\Models\AppealDocumentHistory;
use App\Models\BusinessPhoto;
use App\Repositories\Enums\DocumentSourceTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class AppealDocumentHistoryRepository extends BaseRepository implements IAppealDocumentHistoryRepository
{
    public function __construct(AppealDocumentHistory $model)
    {
        parent::__construct($model);
    }


}

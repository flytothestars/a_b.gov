<?php

namespace App\Repositories;


use App\Models\Appeal;

class AppealForCamundaRepository extends MioBaseRepository implements IAppealForCamundaRepository
{
    public function __construct(
        Appeal $model
    )
    {
        parent::__construct($model);
    }
}

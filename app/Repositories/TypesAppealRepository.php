<?php


namespace App\Repositories;


use App\Models\ServiceGroup;
use App\Models\TypesAppeal;
use Illuminate\Database\Eloquent\Collection;

class TypesAppealRepository extends BaseRepository implements ITypesAppealRepository
{
    public function __construct(TypesAppeal $model)
    {
        parent::__construct($model);
    }
}

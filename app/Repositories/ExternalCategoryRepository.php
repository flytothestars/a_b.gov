<?php


namespace App\Repositories;


use App\Models\CategoryMap;
use App\Models\ExternalCategory;
use App\Models\ServiceGroup;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ExternalCategoryRepository extends MioBaseRepository implements IExternalCategoryRepository
{
    public function __construct(ExternalCategory $model)
    {
        parent::__construct($model);
    }
}

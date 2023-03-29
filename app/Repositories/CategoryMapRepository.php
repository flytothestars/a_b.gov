<?php


namespace App\Repositories;


use App\Models\CategoryMap;
use App\Models\ServiceGroup;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CategoryMapRepository extends MioBaseRepository implements ICategoryMapRepository
{
    public function __construct(CategoryMap $model)
    {
        parent::__construct($model);
    }

    public function findByExternalId($externalId): ?Model
    {
        return $this->model->where('external_category_id', $externalId)->first();
    }
}

<?php


namespace App\Repositories;


use App\Models\NewsCategory;
use Illuminate\Database\Eloquent\Model;

class NewsCategoryRepository extends BaseRepository implements INewsCategoryRepository
{
    public function __construct(NewsCategory $model)
    {
        parent::__construct($model);
    }

    public function findByCode($code): ?Model
    {
        return $this->model->query()->where('code', $code)->first();
    }

}

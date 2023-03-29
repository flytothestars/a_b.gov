<?php


namespace App\Repositories;


use App\Models\FrontViewServiceGroup;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

class FrontViewServiceGroupRepository extends BaseRepository implements IFrontViewServiceGroupRepository
{
    public function __construct(FrontViewServiceGroup $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        $model = $this->model;

        if ($this->isTranslatebale)
            $model = $model->with("translations");

        if ($this->isStorable)
            $model = $model->with("files");

        return $model->orderBy('order_no')->get();
    }

}

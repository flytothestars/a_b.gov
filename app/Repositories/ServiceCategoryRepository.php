<?php


namespace App\Repositories;


use App\Models\ServiceCategory;
use App\Models\ServiceGroup;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

class ServiceCategoryRepository extends BaseRepository implements IServiceCategoryRepository
{
    public function __construct(ServiceCategory $model)
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

    public function getListExistsInCategoryAppeals($typesAppeal): Collection
    {
        $model = $this->model;

        if ($this->isTranslatebale)
            $model = $model->with("translations");

        if ($this->isStorable)
            $model = $model->with("files");

        return $model
            ->whereHas('categoryAppeal', function (Builder $query) use($typesAppeal){
                $query->where('types_appeal_id', $typesAppeal);
            })
            ->orderBy('order_no')->get();
    }

    public function getTopList()
    {
        $model = $this->model;

        if ($this->isTranslatebale)
            $model = $model->with("translations");

        if ($this->isStorable)
            $model = $model->with("files");

        return $model
            ->orderBy('order_no')->get();
    }

}

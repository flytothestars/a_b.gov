<?php


namespace App\Repositories;


use App\Models\ServiceGroup;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

class ServiceGroupRepository extends MioBaseRepository implements IServiceGroupRepository
{
    public function __construct(ServiceGroup $model)
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

        return $model->where('id', '!=', 'b28774d2-b8aa-47c5-ba9c-5fa39ddd0c34')
        ->where('id', '!=', '81d51d67-700d-476c-aae4-1e3571b8e84e')
        ->where('id', '!=', '17fca7d8-47ce-4c98-abb6-ee3bb405a9db')->orderBy('order_no')->get();
    }

    public function getListExistsInCategoryAppeals($typesAppeal): Collection
    {
        $model = $this->model;

        if ($this->isTranslatebale)
            $model = $model->with("translations");

        if ($this->isStorable)
            $model = $model->with("files");

        return $model
            ->whereHas('categoryAppeal', function (Builder $query) use ($typesAppeal) {
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
            ->has('files')
            ->orderBy('order_no')->get();
    }

    public function getOurListOfCategory()
    {
        $model = $this->model;

        if ($this->isTranslatebale)
            $model = $model->with("translations");

        return $model
//            ->whereNull('mio_id')
            ->orderBy('order_no')->get();
    }

}

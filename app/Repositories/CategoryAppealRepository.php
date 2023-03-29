<?php


namespace App\Repositories;


use App\Models\CategoryAppeal;

class CategoryAppealRepository extends BaseRepository implements ICategoryAppealRepository
{
    public function __construct(CategoryAppeal $model)
    {
        parent::__construct($model);
    }

    public function getByServiceCategoryAndTypeAppeal($typeAppeal, $serviceCategory, $notEqual = null)
    {
        $model = $this->model;

        if ($this->isTranslatebale)
            $model = $model->with("translations");

        if ($this->isStorable)
            $model = $model->with("files");

        if (!is_null($serviceCategory)) {
            $model = $model->where('service_category_id', $serviceCategory);
        }

        if (!is_null($typeAppeal)) {
            $model = $model->where('types_appeal_id', $typeAppeal);
        }
        if (!is_null($notEqual)) {
            $model = $model->where('id', '<>', $notEqual);
        }

        return $model->distinct(['name', 'order_no'])->orderBy('order_no')->orderBy('name')->get();
    }

    public function getByCategoryGroup($serviceGroup)
    {
        $model = $this->model;

        if ($this->isTranslatebale)
            $model = $model->with("translations");

        if ($this->isStorable)
            $model = $model->with("files");

        return $model->where('service_category_id', $serviceGroup)->distinct('name')->orderBy('name')->get();
    }
}

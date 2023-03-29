<?php


namespace App\Repositories;


use App\Models\FreeEducation;

class FreeEducationRepositoriy extends BaseRepository implements IFreeEducationRepositoriy
{
    public function __construct(FreeEducation $model)
    {
        parent::__construct($model);
    }

    public function getByCategory($category)
    {
        $model = $this->model;
        $model = $model->where('category_appeals_id', $category);

        if ($this->isTranslatebale)
            $model = $model->with("translations");


        return $model->first();
    }
}

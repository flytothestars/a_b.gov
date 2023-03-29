<?php


namespace App\Repositories;


use App\Models\Partner;
use Illuminate\Database\Eloquent\Collection;

class PartnerRepository extends BaseRepository implements IPartnerRepository
{
    public function __construct(Partner $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        $model = $this->model;

        if($this->isTranslatebale)
            $model = $model->with("translations");

        if($this->isStorable)
            $model = $model->with("files");

        return $model->orderBy('order_no')->get();
    }
}

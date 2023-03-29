<?php


namespace App\Repositories;


use App\Models\BusinessActivityType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class BusinessActivityTypeRepository extends BaseRepository implements IBusinessActivityTypeRepository
{
    public function __construct(BusinessActivityType $model)
    {
        parent::__construct($model);
    }

    public function getByBusinessId($id): Collection
    {
        $businessActivityType = parent::query()
            ->where('business_id', $id)
            ->first();
        if($businessActivityType)
            return $businessActivityType->activityType()->get();
        else
            return Collection::make();
    }
}

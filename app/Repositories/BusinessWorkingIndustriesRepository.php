<?php


namespace App\Repositories;


use App\Models\BusinessActivityType;
use App\Models\BusinessWorkingIndustries;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class BusinessWorkingIndustriesRepository extends BaseRepository implements IBusinessWorkingIndustriesRepository
{
    public function __construct(BusinessWorkingIndustries $model)
    {
        parent::__construct($model);
    }

    public function getByBusinessId($id): Collection
    {
        $businessWorkingIndustry = parent::query()
            ->where('business_id', $id)
            ->first();
        if($businessWorkingIndustry)
            return $businessWorkingIndustry->activityType()->get();
        else
            return Collection::make();
    }
}

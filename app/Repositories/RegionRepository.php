<?php


namespace App\Repositories;


use App\Models\Region;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class RegionRepository extends MioBaseRepository implements IRegionRepository
{
    public function __construct(Region $model)
    {
        parent::__construct($model);
    }

    final public function getListByCityId(string $city_id): Collection
    {
        return $this->query()
                     ->where('city_id', $city_id)
                     ->get();
    }
}

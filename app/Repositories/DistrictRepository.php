<?php


namespace App\Repositories;


use App\Models\District;
use Illuminate\Database\Eloquent\Collection;

class DistrictRepository extends MioBaseRepository implements IDistrictRepository
{
    public function __construct(District $model)
    {
        parent::__construct($model);
    }

    public function withOutMIO()
    {
        return parent::query()->whereNull('mio_id')->get();
    }

    final public function getListByCityId(string $city_id): Collection
    {
        return $this->query()
                    ->where('city_id', $city_id)
                    ->get();
    }
}

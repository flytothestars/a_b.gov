<?php


namespace App\Repositories;


use App\Models\City;

class CityRepository extends MioBaseRepository implements ICityRepository
{
    public function __construct(City $model)
    {
        parent::__construct($model);
    }
}

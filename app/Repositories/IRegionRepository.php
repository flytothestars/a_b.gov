<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Collection;

interface IRegionRepository extends IRepository, IMioIntegration
{

    public function getListByCityId(string $city_id): Collection;

}

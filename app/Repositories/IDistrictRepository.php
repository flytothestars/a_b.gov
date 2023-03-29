<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface IDistrictRepository extends IRepository, IMioIntegration
{
    public function withOutMIO();

    public function getListByCityId(string $city_id);
}

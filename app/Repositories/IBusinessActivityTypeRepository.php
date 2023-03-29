<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

interface IBusinessActivityTypeRepository extends IRepository
{
    public function getByBusinessId($id): Collection;
}

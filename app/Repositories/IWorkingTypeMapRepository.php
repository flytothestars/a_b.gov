<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

interface IWorkingTypeMapRepository extends IRepository
{
    public function findWorkingType($activityTypeId): ?Model;
}

<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

interface IAppealForDistrictCuratorRepository extends IFindable, IUpdatable
{
    public function assignCoExecutor($id, $attributes): ?Model;
    public function complete($id, $attributes): ?Model;
    public function reject($id, $attributes): ?Model;
    public function findAppealsByAuthUser($attributes);
    public function allByFilter($attributes);
}

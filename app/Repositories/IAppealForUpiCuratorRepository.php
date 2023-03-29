<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

interface IAppealForUpiCuratorRepository extends IFindable, IUpdatable
{
    public function backToWork($id): ?Model;
    public function assignExecutor($id, $attributes): ?Model;
    public function complete($id, $attributes): ?Model;
    public function reject($id, $attributes): ?Model;
    public function findAppealsByAuthUser($attributes);
    public function allByFilter($attributes);
}

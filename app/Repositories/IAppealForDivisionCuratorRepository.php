<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

interface IAppealForDivisionCuratorRepository extends IFindable, IUpdatable
{
    public function findAppealsByAuthUser($attributes);
    public function allByFilter($attributes);
    public function complete($id, $attributes): ?Model;
    public function backToWork($id): ?Model;
}

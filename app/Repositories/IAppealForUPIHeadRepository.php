<?php


namespace App\Repositories;

interface IAppealForUPIHeadRepository extends IFindable, IUpdatable
{
    public function findAppealsByAuthUser($attributes);
    public function allByFilter($attributes);
}

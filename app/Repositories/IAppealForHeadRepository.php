<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

interface IAppealForHeadRepository extends IFindable, IUpdatable
{
    public function findAppealsByAuthUser($attributes);
    public function allByFilter($attributes);
}

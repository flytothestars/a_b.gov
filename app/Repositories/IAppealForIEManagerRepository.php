<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

interface IAppealForIEManagerRepository extends IFindable, IUpdatable
{
    public function findAppealsByAuthUser($attributes);
    public function allByFilter($attributes);
    public function ieAccessAppeals($request, $id);
    public function ieRejectAppeals($request, $id);
}

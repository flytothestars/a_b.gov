<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

interface IAppealRepository extends IRepository, IMioIntegration
{
    public function getAppealsByUserId($user_id);
    public function getAllAppealsByUserId($user_id);
    public function getAppealById($id);
    public function findAppealsByAuthUser($attributes);
    public function allByFilter($attributes);
    public function allByFilterForExport($attributes);
    public function getAppealsByFilters($params = array());

}

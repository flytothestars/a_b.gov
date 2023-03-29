<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

interface IAppealForDistributorRepository extends IFindable, IUpdatable
{
    public function getToWork($id): ?Model;
    public function autoAssignDistributor($id): ?Model;
    public function backToWork($id): ?Model;
    public function cantContact($id): ?Model;
    public function byProduct($request, $id): ?Model;
    public function notByProduct($request, $id): ?Model;
    public function assignExecutor($id, $attributes): ?Model;
    public function assignCoExecutor($id, $attributes): ?Model;
    public function complete($id, $attributes): ?Model;
    public function reject($id, $attributes): ?Model;
    public function findAppealsByAuthUser($attributes);
    public function allByFilter($attributes);
    public function assignCurator($id, $attributes): ?Model;
    public function attachManagerDocuments($id, $attributes): ?Model;

    public function createAppealByParent(string $parent_id, $attributes) : Model;
    public function createAppealByBusiness(string $business_id, $attributes) : Model;
}

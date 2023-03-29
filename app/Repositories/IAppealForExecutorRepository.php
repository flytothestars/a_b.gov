<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

interface IAppealForExecutorRepository extends IRepository
{
    public function getToWork($id): ?Model;
    public function assignCoExecutor($id, $attributes): ?Model;
    public function complete($id, $attributes): ?Model;
    public function reject($id, $attributes): ?Model;
    public function findAppealsByAuthUser($attributes);
    public function allByFilter($attributes);
    public function attachManagerDocuments($id, $attributes): ?Model;
    public function backToWork($id): ?Model;
    public function cantContact($id): ?Model;
    public function byProduct($request, $id): ?Model;
    public function notByProduct($request, $id): ?Model;
}

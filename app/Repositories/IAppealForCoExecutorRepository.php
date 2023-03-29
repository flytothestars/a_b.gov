<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

interface IAppealForCoExecutorRepository extends IRepository
{
    public function complete($id, $attributes): ?Model;
    public function reject($id, $attributes): ?Model;
    public function findAppealsByAuthUser($attributes);
    public function allByFilter($attributes);
    public function attachManagerDocuments($id, $attributes): ?Model;
}

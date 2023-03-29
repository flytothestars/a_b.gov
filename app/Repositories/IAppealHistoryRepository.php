<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface IAppealHistoryRepository
{
    public function createByAppeal(Model $appeal): ?Model;
    public function getByAppeal($appealId): Collection;
    public function firstByAppeal($appealId): ?Model;
    public function getByAppealAll($appealId): Collection;
}

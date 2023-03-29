<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface INewsRepository extends IRepository
{
    public function findByCode($code): ?Model;
    public function getTop($count): Collection;
    public function getByCategory($newsCategoryId): \Illuminate\Contracts\Pagination\LengthAwarePaginator;
    public function allByFilter($attributes);
}

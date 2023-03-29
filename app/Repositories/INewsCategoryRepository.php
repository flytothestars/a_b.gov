<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface INewsCategoryRepository extends IRepository
{
    public function findByCode($code): ?Model;
}

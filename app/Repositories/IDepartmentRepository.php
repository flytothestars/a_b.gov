<?php


namespace App\Repositories;

use Illuminate\Support\Collection;

interface IDepartmentRepository extends IRepository
{
    public function childrenListByParentRecursive($itemList): Collection;
}

<?php


namespace App\Repositories;


use App\Helpers\Helper;
use App\Models\Department;
use App\Models\Profile;
use App\Repositories\Enums\RoleIntEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Ramsey\Uuid\Uuid;

class DepartmentRepository extends BaseRepository implements IDepartmentRepository
{

    public function __construct(Department $model)
    {
        parent::__construct($model);
    }

    public function childrenListByParentRecursive($itemList): Collection
    {
        $departments = new Collection();
        $departmentList = Department::query()->whereIn('id', $itemList)->get();
        foreach ($departmentList as $department){
            $departments = $departments->merge($department->childrenRecursiveId());
        }
        return $departments;
    }
}

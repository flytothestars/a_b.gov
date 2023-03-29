<?php


namespace App\Repositories;


use App\Models\District;
use Spatie\Permission\Models\Role;

class RoleRepository extends BaseRepository implements IRoleRepository
{
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }
}

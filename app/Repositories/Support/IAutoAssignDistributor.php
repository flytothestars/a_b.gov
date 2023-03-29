<?php

namespace App\Repositories\Support;

use App\Models\User;
use App\Repositories\Enums\RoleIntEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface IAutoAssignDistributor
{

    public function autoAssignDistributor($id): ?Model;

}

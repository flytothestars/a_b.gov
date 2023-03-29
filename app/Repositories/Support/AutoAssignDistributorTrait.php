<?php

namespace App\Repositories\Support;

use App\Models\User;
use App\Repositories\Enums\RoleIntEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait AutoAssignDistributorTrait
{

    abstract function assignDistributor($id, $userId): ?Model;

    private function getNextDistributorForAutoAssignment(): ?Model
    {
        $user = $this->getNextDistributorBaseQuery()
                     ->whereNull('profiles.last_assignment_date')
                     ->first('users.*')
        ;

        if (!$user) {
            $user = $this->getNextDistributorBaseQuery()
                         ->orderBy('profiles.last_assignment_date')
                         ->first('users.*')
            ;
        }

        if ($user) {
            $user->profile->update(
                [
                    'last_assignment_date' => new \DateTime("now", new \DateTimeZone("UTC")),
                ]
            );
        }

        return $user;
    }

    private function getNextDistributorBaseQuery(): Builder
    {
        $userQuery = User::query()
                         ->from('users')
                         ->join('profiles', 'profiles.user_id', '=', 'users.id')
                         ->whereHas(
                             'roles',
                             function ($q)
                             {
                                 $q->where('role_id', RoleIntEnum::Distributor);
                             }
                         )
//                        ->where('phone', '!=', '+77788083341')//temp till 19.11
        ;

        return $userQuery;
    }

}

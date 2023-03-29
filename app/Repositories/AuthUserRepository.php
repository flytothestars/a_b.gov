<?php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthUserRepository implements IAuthUserRepository
{

    public function changePwd(array $attributes)
    {
        User::query()->find(auth()->user()->id)
            ->update(['password'=> Hash::make($attributes['password'])]);
    }
}

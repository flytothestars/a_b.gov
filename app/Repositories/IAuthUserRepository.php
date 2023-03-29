<?php


namespace App\Repositories;


interface IAuthUserRepository
{
    public function changePwd(array $attributes);
}


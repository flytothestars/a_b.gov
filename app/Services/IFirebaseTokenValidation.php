<?php

namespace App\Services;

interface IFirebaseTokenValidation
{

    public function validateFirebaseToken(string $token, string $phone): bool;

}

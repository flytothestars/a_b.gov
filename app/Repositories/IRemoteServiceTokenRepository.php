<?php


namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface IRemoteServiceTokenRepository
{
    public function getByName($serviceName);
    public function setByName($serviceName, $token, $refreshToken);
    public function parseToken($token): array;
}

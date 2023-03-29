<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

interface ICategoryMapRepository extends IRepository, IMioIntegration
{
    public function findByExternalId($externalId): ?Model;
}

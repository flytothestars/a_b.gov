<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface IMioIntegration
{
    public function findByMioId($mioId): ?Model;
    public function getByBusinessId($id): Collection;
    public function setMioId($entityId, $mioId): ?Model;
    public function findByBusinessId($id);
}

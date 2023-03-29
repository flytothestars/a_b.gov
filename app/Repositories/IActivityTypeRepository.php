<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Nullable;

interface IActivityTypeRepository extends IRepository, IMioIntegration
{
    public function createByParams(string $code, string $name, $tags, $parentId, $nodeType, $mioId): Model;
}

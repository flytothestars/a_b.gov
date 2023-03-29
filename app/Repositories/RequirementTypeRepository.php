<?php


namespace App\Repositories;


use App\Models\RequirementType;

class RequirementTypeRepository extends MioBaseRepository implements IRequirementTypeRepository
{
    public function __construct(RequirementType $model)
    {
        parent::__construct($model);
    }
}

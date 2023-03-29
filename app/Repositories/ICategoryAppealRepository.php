<?php


namespace App\Repositories;

interface ICategoryAppealRepository extends IRepository
{
    public function getByServiceCategoryAndTypeAppeal($typeAppeal, $serviceGroup, $notEqual = null);
    public function getByCategoryGroup($serviceGroup);
}

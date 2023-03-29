<?php


namespace App\Repositories;


interface IServiceGroupRepository extends IRepository, IMioIntegration
{
    public function getListExistsInCategoryAppeals($typesAppeal);

    public function getTopList();

    public function getOurListOfCategory();
}

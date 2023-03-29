<?php


namespace App\Repositories;


interface IServiceCategoryRepository extends IRepository
{
    public function getListExistsInCategoryAppeals($typesAppeal);

    public function getTopList();
}

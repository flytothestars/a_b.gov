<?php


namespace App\Repositories;


interface IAppealStatusRepository extends IRepository
{
    public function getAppealStatuesForClient();
}

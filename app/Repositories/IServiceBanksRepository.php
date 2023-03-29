<?php


namespace App\Repositories;

interface IServiceBanksRepository extends IRepository
{
    public function getById($bankID);
    public function getAllToAccount();
    public function getAllToLoan();
    public function getToAccount($bankID);
    public function getToLoan($bankID);
}

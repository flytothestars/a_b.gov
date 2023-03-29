<?php


namespace App\Repositories;

interface IFreeEducationRepositoriy extends IRepository
{
    public function getByCategory($category);
}

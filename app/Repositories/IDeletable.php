<?php


namespace App\Repositories;


interface IDeletable
{
    public function delete($id) : int;
}

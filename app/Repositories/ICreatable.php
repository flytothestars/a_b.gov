<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

interface ICreatable
{
    public function create(array $attributes): Model;
}

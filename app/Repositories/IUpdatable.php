<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

interface IUpdatable
{
    public function update($id, array $attributes): Model;
}

<?php

namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

interface IRepository extends IUpdatable, IFindable, IDeletable, ICreatable
{

}

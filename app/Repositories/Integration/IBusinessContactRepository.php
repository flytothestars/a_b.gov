<?php

namespace App\Repositories\Integration;

use App\Repositories\ICreatable;
use App\Repositories\IDeletable;
use App\Repositories\IMioIntegration;
use App\Repositories\IUpdatable;

interface IBusinessContactRepository extends ICreatable, IUpdatable, IDeletable, IMioIntegration
{

}

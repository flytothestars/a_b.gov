<?php

namespace App\Repositories\Integration;

use App\Repositories\ICreatable;
use App\Repositories\IMioIntegration;
use App\Repositories\IUpdatable;

interface IOrganizationRepository extends ICreatable, IUpdatable, IMioIntegration
{

}

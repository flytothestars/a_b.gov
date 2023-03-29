<?php

namespace App\Services\Camunda;

use App\Services\MSB\IApplicationRequest;
use App\Services\MSB\IProgramByBinIinResponse;
use Ramsey\Uuid\Guid\Guid;

interface ICamundaTaskService
{
    public function externalTask($externalTask): ?\stdClass;
}

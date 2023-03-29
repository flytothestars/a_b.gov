<?php

namespace App\Services;

use App\Services\MSB\IApplicationRequest;
use App\Services\MSB\IProgramByBinIinResponse;

interface IMsbService
{

    public function getProgramByBinIinRequest(string $binIin): IProgramByBinIinResponse;

    public function sendApplication(IApplicationRequest $application);



}

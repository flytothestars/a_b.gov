<?php

namespace App\Integration;

use App\Services\MSB\IApplicationRequest;

interface IMSBRestClient
{
    public function getProgramByBinIinRequest(string $binIin): array;

    public function sendMSBApplication(IApplicationRequest $application): bool;

}

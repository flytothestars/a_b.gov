<?php

namespace App\Services;

interface IReportNotificationService
{

    public function sendMessage(string $message): void;

}

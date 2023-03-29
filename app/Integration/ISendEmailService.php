<?php

namespace App\Integration;


interface ISendEmailService
{
    public function sendEmail();
    public function sendEmailEveryHour();
}

<?php

namespace App\Repositories\Report;

use App\Repositories\IRepository;

interface IReportRepository
{

    public function getInvestmentsReport(array $attributes): array;
    public function getIndustryReport(array $attributes): array;
    public function getTradeReport(array $attributes): array;
    public function getPrtReport(array $attributes): array;
    public function getBusinessStatReport(array $attributes): array;

}

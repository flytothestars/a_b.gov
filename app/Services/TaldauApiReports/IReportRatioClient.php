<?php

namespace App\Services\TaldauApiReports;

interface IReportRatioClient
{

    public function fetchReportRatio(string $url): array;

}

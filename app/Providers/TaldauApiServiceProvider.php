<?php

namespace App\Providers;

use App\Services\IReportNotificationService;
use App\Services\ReportNotificationService;
use App\Services\TaldauApiReports\IReportRatioClient;
use App\Services\TaldauApiReports\ReportRatioClient;
use Illuminate\Support\ServiceProvider;

class TaldauApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    final public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    final public function boot(): void
    {
        $this->app->bind(IReportRatioClient::class, ReportRatioClient::class);
        $this->app->bind(IReportNotificationService::class, ReportNotificationService::class);
    }
}

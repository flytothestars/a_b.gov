<?php

namespace App\Providers;


use App\Integration\IMioIntegrationService;
use App\Integration\ISendEmailService;
use App\Integration\SendEmailService;
use App\Integration\IMIORestClient;
use App\Integration\IMSBRestClient;
use App\Integration\MioIntegrationService;
use App\Integration\MIORestClient;
use App\Integration\MSBRestClient;
use App\Services\Camunda\CamundaService;
use App\Services\Camunda\CamundaTaskService;
use App\Services\Camunda\ICamundaService;
use App\Services\Camunda\ICamundaTaskService;
use App\Services\FirebaseTokenValidation;
use App\Services\GovernmentProgramsReports\IGovernmentProgramsImportService;
use App\Services\GovernmentProgramsReports\GovernmentProgramsImportService;
use App\Services\IFirebaseTokenValidation;
use App\Services\IImageConverter;
use App\Services\ImageConverter;
use App\Services\IMsbService;
use App\Services\MSBService;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register() : void
    {
        //
    }

    public function boot() : void
    {
        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('http');
        }

        $this->app->bind(IImageConverter::class, ImageConverter::class);
        Carbon::setLocale(config('app.locale'));
        setlocale(LC_TIME,'ru_RU');

        $this->app->bind(IMIORestClient::class, MIORestClient::class);
        $this->app->bind(IMioIntegrationService::class, MioIntegrationService::class);
        $this->app->bind(IMSBRestClient::class, MSBRestClient::class);
        $this->app->bind(IMsbService::class, MSBService::class);
		$this->app->bind(ISendEmailService::class, SendEmailService::class);
        $this->app->bind(ICamundaService::class, CamundaService::class);
        $this->app->bind(ICamundaTaskService::class, CamundaTaskService::class);

        $this->app->singleton(IFirebaseTokenValidation::class, FirebaseTokenValidation::class);
        $this->app->singleton(IGovernmentProgramsImportService::class, GovernmentProgramsImportService::class);
    }
}

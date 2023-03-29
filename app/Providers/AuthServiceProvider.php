<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot() : void
    {
        $this->registerPolicies();

        Passport::routes();
        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));

        Passport::tokensCan([
            'Administrator' => 'full access',
            'Distributor' => 'Distributor access',
            'Manager' => 'Executor access',
            'IEManager' => 'Distributor access',
            'CoExecutor' => 'CoExecutor access',
            'Head' => 'Head access',
            'UpiCurator' => 'UpiCurator access',
            'DistrictCurator' => 'DistrictCurator access',
            'DivisionCurator' => 'DivisionCurator access',
            'MIOIntegration' => 'MIOIntegration access',
            'UPIHead' => 'UPIHead access',
            'MSBIntegration' => 'MSBIntegration access',
            'PressSecretary' => 'PressSecretary access',
        ]);
     }
}

<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Carbon\Carbon;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();
        Passport::tokensExpireIn(Carbon::now()->addMinutes(config('open.token_expire_in')));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(config('open.refresh_token_expire_in')));
        //scope控制,如果需要对不同用户进行不同范围控制，将范围与用户的映射设计到数据表中
        $scopes = config('open.scopes');
        Passport::tokensCan($scopes);
    }
}

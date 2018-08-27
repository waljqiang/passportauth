<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\PassportServiceProvider as Passport;
use Illuminate\Auth\RequestGuard;
use Illuminate\Support\Facades\Auth;
use App\Rewrites\Passports\TokenGuard;
use League\OAuth2\Server\ResourceServer;
use Laravel\Passport\TokenRepository;
use Laravel\Passport\ClientRepository;

class PassportServiceProvider extends Passport{
	/**
     * Make an instance of the token guard.
     *
     * @param  array  $config
     * @return \Illuminate\Auth\RequestGuard
     */
    protected function makeGuard(array $config){
        return new RequestGuard(function ($request) use ($config) {
            return (new TokenGuard(
                $this->app->make(ResourceServer::class),
                Auth::createUserProvider($config['provider']),
                $this->app->make(TokenRepository::class),
                $this->app->make(ClientRepository::class),
                $this->app->make('encrypter')
            ))->user($request);
        }, $this->app['request']);
    }

}

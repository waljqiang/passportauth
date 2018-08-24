<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\PassportServiceProvider as Passport;
use App\Passport\Grant\AuthCodeGrant;
use Laravel\Passport\Bridge\AuthCodeRepository;
use Laravel\Passport\Bridge\RefreshTokenRepository;
use DateInterval;

class PassportServiceProvider extends Passport{

}

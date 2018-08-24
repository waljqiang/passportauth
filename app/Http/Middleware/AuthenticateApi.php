<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate;

use League\OAuth2\Server\ResourceServer;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;


class AuthenticateApi extends Authenticate{

    protected function authenticate(array $gards){
        if($this->auth->guard('api')->check()){
            return $this->auth->shouldUse('api');
        }
        throw new UnauthorizedHttpException('','111');
    }
}

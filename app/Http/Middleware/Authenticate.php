<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Auth;
use App\Exceptions\CheckAuthException;

class Authenticate extends Auth
{
    /**
     * Determine if the user is logged in to any of the given guards.
     *
     * @param  array  $guards
     * @return void
     *
     * @throws \App\Exceptions\CheckAuthException
     */
    protected function authenticate(array $guards)
    {
        if (empty($guards)) {
            return $this->auth->authenticate();
        }
        try{
            foreach ($guards as $guard) {
                if ($this->auth->guard($guard)->check()) {
                    return $this->auth->shouldUse($guard);
                }
            }
        }catch(\Exception $e){
             throw new CheckAuthException($e->getMessage(),$e->getCode(),$e->getErrorType(),$e->getHttpStatusCode(),$e->getHint()); 
        }
    }
}

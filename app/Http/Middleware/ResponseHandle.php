<?php

namespace App\Http\Middleware;

use App\Exceptions\CheckAuthException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ResponseHandle
{
    private $errCode = [
        1 => 'TOKEN_INVALID',
        2 => 'GRANTTYPE_UNSUPPORTED',
        3 => 'PARAMS_INVALID',
        4 => 'CLIENT_INVALID',
        5 => 'SCOPE_INVALID',
        6 => 'CREDENTIALS_INVALID',
        7 => 'AUTH_SERVER_ERR',
        8 => 'REFRESH_TOKEN_INVALID',
        9 => 'ACCESS_DENEID',
        10 => 'GRANT_INVALID'
    ];

    /**
     * Handle an incoming request.
     *
     * @param  Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        /**
         * @var Response $response
         */
        $response = $next($request);

        if ($response->exception) {
            if ($response->exception instanceof CheckAuthException) {
                return $this->makeErrorResponse($response->exception->getHttpStatusCode(), $this->makeCode($response->exception->getCode()), $response->exception->getMessage(), $response->exception->getHint());
            }
        }
        return $this->makeSuccessResponse($response->getStatusCode(),$response->getData());
    }

    /**
     * @param $errCode
     * @param $message
     * @param string $hit
     * @return \Illuminate\Http\JsonResponse
     */
    protected function makeErrorResponse($status,$errCode,$message,$hint=''){
        return response()->json(compact('status','errCode','message','hint'));
    }


    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function makeSuccessResponse($status,$data=[]){
        $errCode = config('exceptions.SUCCESS');
        return response()->json(compact('status','errCode','data'));
    }

    protected function makeCode($errCode){
        return isset($this->errCode[$errCode]) ? config('exceptions.' . $this->errCode[$errCode]) : $errCode;
    }

}

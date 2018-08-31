<?php

namespace App\Http\Middleware;

use Illuminate\Validation\ValidationException;
use App\Exceptions\CheckAuthException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ResponseHandle
{
    /**
     * 映射passport默认错误码
     */
    private $errorCode = [
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
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle($request, Closure $next){
        /**
         * @var Response $response
         */
        $response = $next($request);
        if ($response->exception) {
            if ($response->exception instanceof ValidationException) {
                $errorCode = array_map(function ($val) {
                    return (int)$val;
                }, $response->exception->validator->errors()->all());
                return $this->makeErrorResponse('invalid params',400,$errorCode,'please check the params');
            }
            if ($response->exception instanceof CheckAuthException) {
                return $this->makeErrorResponse($response->exception->getMessage(),$response->exception->getHttpStatusCode(), $this->makeCode($response->exception->getCode()),$response->exception->getHint());
            }
            return $this->makeErrorResponse($response->exception->getMessage(),500,400100);
        }
        return $this->makeSuccessResponse($response->getStatusCode(),$response->getData());
    }

    /**
     * @param $errorCode
     * @param $message
     * @param string $hit
     * @return \Illuminate\Http\JsonResponse
     */
    protected function makeErrorResponse($message='',$status='',$errorCode='',$hint=''){
        return response()->json(compact('status','errorCode','message','hint'));
    }


    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function makeSuccessResponse($status,$data=[]){
        $errorCode = config('exceptions.SUCCESS');
        return response()->json(compact('status','errorCode','data'));
    }

    /**
     * 转换paasport插件默认错误码为应用错误码
     * @param $errorCode
     * @return $errorCode
     */
    protected function makeCode($errorCode){
        return isset($this->errorCode[$errorCode]) ? config('exceptions.' . $this->errorCode[$errorCode]) : $errorCode;
    }

}

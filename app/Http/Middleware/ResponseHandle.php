<?php

namespace App\Http\Middleware;

use App\Exceptions\CheckAuthException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ResponseHandle
{

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
                return $this->makeErrorResponse($response->exception->getHttpStatusCode(), $response->exception->getCode(), $response->exception->getMessage(), $response->exception->getHint());
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

}

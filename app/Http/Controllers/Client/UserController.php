<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Requests\SynuserRequest;
use App\Http\Requests\CheckRequest;
use App\Http\Controllers\Controller;
use Auth;
use App\Exceptions\CheckAuthException;
use Laravel\Passport\TokenRepository;
use App\Services\UserService;

class UserController extends Controller
{
	/**
     * The token repository implementation.
     *
     * @var \Laravel\Passport\TokenRepository
     */
    protected $tokenRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Laravel\Passport\TokenRepository  $tokenRepository
     * @return void
     */
    public function __construct(TokenRepository $tokenRepository){
        $this->tokenRepository = $tokenRepository;
    }


    /**
     * check token under the type of code
     * @param  \App\Http\Requests\CheckRequest $CheckRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function check(CheckRequest $request){
    	$scopes = $request->input('scopes');
        foreach ($scopes as $scope) {
            if(!$request->user()->tokenCan($scope)){
                throw CheckAuthException::noScope($scope);
            }
        }
        return Auth::user();
    }

    /**
     * check token under the type of client_credentials
     * @param  \App\Http\Requests\CheckRequest $CheckRequest
     * @param  \App\Services\UserService $UserService
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkClient(CheckRequest $request,UserService $userService){
        $bearerToken = $request->header('Authorization');
        $user = $userService->getUserByToken($bearerToken,1);
        if($user){
            return compact('user');
        }else{
            throw new CheckAuthException('unknowen error',400100,'unknowen_error');
        }
    }

    /**
     * Get the clients of the user
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOauthClients(Request $request){
    	$tokens = $this->tokenRepository->forUser($request->user()->getKey());
        return $tokens->load('client')->load('user')->filter(function ($token) {
            return ! $token->client->firstParty() && ! $token->revoked;
        })->values();
    }

    /**
     * Synchronous the data of the user
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Services\UserService $UserService
     * @return \Illuminate\Http\JsonResponse
     */
    public function synCareUser(SynuserRequest $request,UserService $userService){
        $result = $userService->synCareUser($request->all());
        return compact('result');
    }
}

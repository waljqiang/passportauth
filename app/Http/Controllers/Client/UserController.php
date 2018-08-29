<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Exceptions\CheckAuthException;
use Laravel\Passport\TokenRepository;
use Lcobucci\JWT\Parser;
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


    public function check(Request $request){
    	$scope = $request->input('scope');
        if(!$request->user()->tokenCan($scope)){
            throw CheckAuthException::noScope($scope);
        }
        return Auth::user();
    }

    public function checkClient(Request $request){
        /*$scope = $request->input('scope');
        if(!$request->user()->tokenCan($scope)){
            throw CheckAuthException::noScope($scope);
        }
        return Auth::user();*/
        $bearerToken = $request->header('Authorization');
        $jwt = trim(preg_replace('/^(?:\s+)?Bearer\s/', '', $bearerToken));
        $token = (new Parser())->parse($jwt);
        dd($token);
    }

    public function getOauthClients(Request $request){
    	$tokens = $this->tokenRepository->forUser($request->user()->getKey());
        return $tokens->load('client')->load('user')->filter(function ($token) {
            return ! $token->client->firstParty() && ! $token->revoked;
        })->values();
    }


    public function synCareUser(Request $request,UserService $userService){
        $result = $userService->synCareUser($request->all());
        return compact('result');
    }
}

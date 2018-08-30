<?php
/**
 * Created by PhpStorm.
 * User: emmanuel
 * Date: 17-8-4
 * Time: 下午7:21
 */

namespace App\Http\Middleware;

use Auth;
use Closure;
use App\Utils\Signature;
use Illuminate\Http\Request;
use League\OAuth2\Server\Grant\AbstractGrant;
use Laravel\Passport\ClientRepository;

class RequestHandle{

    /*
     * \Laravel\Passport\ClientRepository
     */
    private $clientRepository;

    public function __construct(ClientRepository $clientRepository){
        $this->clientRepository = $clientRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null){
        if($request->is('oauth/authorize')){
            $scopes = $request->input('scope');
            if(empty($scopes)){
                $scopes = collect(config('open.scopes'))->keys()->implode(AbstractGrant::SCOPE_DELIMITER_STRING);
                $request->merge(['scope'=>$scopes]);
            }
            $client = $this->clientRepository->find($request->input('client_id'));
            Auth::loginUsingId($client->user_id);
        }
        if($request->is('oauth/token')){
            $scopes = $request->input('scope');
            if(empty($scopes)){
                $scopes = collect(config('open.scopes'))->keys()->implode(AbstractGrant::SCOPE_DELIMITER_STRING);
                $request->merge(['scope'=>$scopes]);
            }
        }
        return $next($request);
    }

}

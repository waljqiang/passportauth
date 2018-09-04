<?php

namespace App\Rewrites\Passports;

use Laravel\Passport\RouteRegistrar as Router;

class RouteRegistrar extends Router{

    /**
     * Register the routes for retrieving and issuing access tokens.
     *
     * @return void
     */
    public function forAccessTokens(){
        $this->router->post('/token', [
            'uses' => 'AccessTokenController@issueToken',
            'middleware' => 'throttle',
        ]);

        $this->router->group(['middleware' => ['web', 'auth']], function ($router) {
            $router->get('/tokens', [
                'uses' => 'AuthorizedAccessTokenController@forUser',
            ]);

            $router->delete('/tokens/{token_id}', [
                'uses' => 'AuthorizedAccessTokenController@destroy',
            ]);
        });
    }

}

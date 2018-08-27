<?php

namespace App\Rewrites\Passports;
use Laravel\Passport\Guards\TokenGuard as Guard;
use League\OAuth2\Server\Exception\OAuthServerException;
use Symfony\Bridge\PsrHttpMessage\Factory\DiactorosFactory;
use App\Exceptions\CheckAuthException;

class TokenGuard extends Guard{
    /**
     * Authenticate the incoming request via the Bearer token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function authenticateViaBearerToken($request)
    {
        // First, we will convert the Symfony request to a PSR-7 implementation which will
        // be compatible with the base OAuth2 library. The Symfony bridge can perform a
        // conversion for us to a Zend Diactoros implementation of the PSR-7 request.
        $psr = (new DiactorosFactory)->createRequest($request);

        try {
            $psr = $this->server->validateAuthenticatedRequest($psr);

            // If the access token is valid we will retrieve the user according to the user ID
            // associated with the token. We will use the provider implementation which may
            // be used to retrieve users from Eloquent. Next, we'll be ready to continue.
            $user = $this->provider->retrieveById(
                $psr->getAttribute('oauth_user_id')
            );

            if (! $user) {
                return;
            }

            // Next, we will assign a token instance to this user which the developers may use
            // to determine if the token has a given scope, etc. This will be useful during
            // authorization such as within the developer's Laravel model policy classes.
            $token = $this->tokens->find(
                $psr->getAttribute('oauth_access_token_id')
            );

            $clientId = $psr->getAttribute('oauth_client_id');

            // Finally, we will verify if the client that issued this token is still valid and
            // its tokens may still be used. If not, we will bail out since we don't want a
            // user to be able to send access tokens for deleted or revoked applications.
            if ($this->clients->revoked($clientId)) {
                return;
            }

            return $token ? $user->withAccessToken($token) : null;
        } catch (OAuthServerException $e) {
            $request->headers->set( 'Authorization', '', true );
            throw new CheckAuthException($e->getMessage(),$e->getCode(),$e->getErrorType(),$e->getHttpStatusCode(),$e->getHint());            
        }
    }
}

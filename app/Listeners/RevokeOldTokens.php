<?php

namespace App\Listeners;

use Laravel\Passport\Events\AccessTokenCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Repositories\AccessTokenRepository;
use App\Repositories\RefreshTokenRepository;

class RevokeOldTokens
{
    private $accessTokenRepository;
    private $refreshTokenRepository;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(AccessTokenRepository $accessTokenRepository,RefreshTokenRepository $refreshTokenRepository)
    {
        $this->accessTokenRepository = $accessTokenRepository;
        $this->refreshTokenRepository = $refreshTokenRepository;
    }

    /**
     * Handle the event.
     *
     * @param  AccessTokenCreated  $event
     * @return void
     */
    public function handle(AccessTokenCreated $event)
    {
        logger('The client[' . $event->clientId . '] of ' . $event->userId . ' access_token id is [' . $event->tokenId . ']');
        $invalidToken = $this->accessTokenRepository->findInvalidToken($event->tokenId,$event->userId,$event->clientId);
        $invalidTokenIDs = $invalidToken->pluck('id');
        $this->accessTokenRepository->revokeInvalidToken($invalidTokenIDs);
        $this->refreshTokenRepository->revokeInvalidRefreshToken($invalidTokenIDs);
    }
}

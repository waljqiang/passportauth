<?php

namespace App\Listeners;

use Laravel\Passport\Events\RefreshTokenCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Repositories\AccessTokenRepository;
use App\Repositories\RefreshTokenRepository;

class PruneOldTokens
{
    private $accessTokenRepository;
    private $refreshTokenRepository;
    /**
     * Create the event listener.
     *
     * @param  $accessTokenRepository App\Repositories\AccessTokenRepository
     * @param  $refreshTokenRepository App\Repositories\RefreshTokenRepository
     * @return void
     */
    public function __construct(AccessTokenRepository $accessTokenRepository,RefreshTokenRepository $refreshTokenRepository){
        $this->accessTokenRepository = $accessTokenRepository;
        $this->refreshTokenRepository = $refreshTokenRepository;
    }

    /**
     * Handle the event.
     *
     * @param  RefreshTokenCreated  $event
     * @return void
     */
    public function handle(RefreshTokenCreated $event){
        $invalidToken = $this->accessTokenRepository->findInvalidToken($event->accessTokenId);
        $invalidTokenIDs = $invalidToken->pluck('id');
        $this->accessTokenRepository->revokeInvalidToken($invalidTokenIDs);
        $this->refreshTokenRepository->revokeInvalidRefreshToken($invalidTokenIDs);
    }
}

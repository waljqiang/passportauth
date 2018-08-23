<?php

namespace App\Repositories;

use App\Entities\RefreshToken;
use Carbon\Carbon;
use Prettus\Repository\Eloquent\BaseRepository;

class RefreshTokenRepository extends BaseRepository{

    public function model(){
        return RefreshToken::class;
    }

    /**
     * revoked invalid refresh_token
     * @param $accessTokenIDs   invalid token IDs
     * @return mixed
     */
    public function revokeInvalidRefreshToken($accessTokenIDs){
        return $this->model->whereIn('access_token_id',$accessTokenIDs)
                                ->update(['revoked'=>true]);
    }
}

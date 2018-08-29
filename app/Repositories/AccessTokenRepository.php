<?php

namespace App\Repositories;

use App\Entities\Token;
use Carbon\Carbon;
use Prettus\Repository\Eloquent\BaseRepository;

class AccessTokenRepository extends BaseRepository{

    public function model(){
        return Token::class;
    }

    /**
     * Find invalid token for the given userID and clientID
     * @param $id   a valid tokenID
     * @param $userID   user ID
     * @param $clientID client ID
     * @return \Laravel\Passport\Token|null
     */
    public function findInvalidToken($id,$userID='',$clientID=''){
        return $this->model->where('id','!=',$id)->when(!empty($userID),function($query) use ($userID){
            $query->where('user_id',$userID);
        },function($query) use ($id){
            $query->where('user_id',function($query) use ($id){
                $query->select('user_id')->from('oauth_access_tokens')->where('id',$id);
            });
        })->when(!empty($clientID),function($query) use ($clientID){
            $query->where('client_id',$clientID);
        },function($query) use ($id){
            $query->where('client_id',function($query) use ($id){
                $query->select('client_id')->from('oauth_access_tokens')->where('id',$id);
            });
        })->where('revoked',false)->get();
    }

    public function findInvalidTokenByClient($id,$clientID){
        return $this->model->where('id','!=',$id)->where('client_id',$clientID)->whereNull('user_id')->get();
    }

    /**
     * revoke old token for the given user and client
     * @param id a new tokenid
     * @param $userID user ID
     * @param $clientID client ID
     * @return boolean
     */
    public function revokeInvalidToken($tokenIDs){
        return $this->model->whereIn('id',$tokenIDs)
                                ->update(['revoked' => true,'updated_at' => Carbon::now()]);
    }
}

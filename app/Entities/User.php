<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = ['name','email','password','created_at','updated_at'];

    public function bussiness(){
        return $this->hasMany(UserBussiness::class,'uid');
    }

    public function client(){
        return $this->hasOne(Client::class,'user_id');
    }

    public function getUserIDAttribute(){
        return $this->bussiness[0]->user_id;
    }

    public function getClientIDAttribute(){
        return $this->client->id;
    }

}

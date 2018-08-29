<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class UserBussiness extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_bussiness';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = ['uid','user_id','type'];

    public function user(){
        return $this->belongsTo(User::class,'uid');
    }

}

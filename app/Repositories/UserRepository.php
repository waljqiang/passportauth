<?php

namespace App\Repositories;

use App\Entities\User;
use Prettus\Repository\Eloquent\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserRepository extends BaseRepository{

    public function model(){
        return User::class;
    }

    public function registerUser($name,$password,$userID,$email = '',$type = 1){
        $time = Carbon::now();
        $userModel = $this->model->where('name',$name)->first();
        if(empty($userModel)){
            $user = [
                'name' => $name,
                'password' => Hash::make($password),
                'email' => $email,
                'created_at' => $time,
                'updated_at' => $time
            ];
            $userModel = $this->model->create($user);
        }
        if($userModel->bussiness->isEmpty() || !$this->hasBussiness($userModel->id,$type)){
            $userModel->bussiness()->Create(['user_id'=>$userID,'uid'=>$userModel->id,'type'=>$type]);
        }     
        return true;
    }

    public function getUser($name){
        return $this->model->where('name',$name)->first();
    }

    protected function hasBussiness($uid,$type){
        return $this->model->whereHas('bussiness',function($query) use ($uid,$type){
            $query->where('uid',$uid)->where('type',$type);
        });
    }

}

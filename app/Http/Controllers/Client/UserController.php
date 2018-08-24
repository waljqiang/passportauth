<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;



class UserController extends Controller
{

    public function check(Request $request){
        if(!$request->user()->tokenCan('screen-getScreenList')){
            throw CheckAuthException::noScope('screen-getScreenList','11');
        }
        return Auth::user();
    }
}

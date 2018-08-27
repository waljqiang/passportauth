<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Exceptions\CheckAuthException;


class UserController extends Controller
{

    public function check(Request $request){
    	$scope = $request->input('scope');
        if(!$request->user()->tokenCan($scope)){
            throw CheckAuthException::noScope('screen-getScreenList');
        }
        return Auth::user();
    }
}

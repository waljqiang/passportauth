<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//同步业务系统数据
Route::post('User/synCareUser','Client\UserController@synCareUser');

//校验access_token
Route::group(['namespace'=>'Client'],function(){
    Route::post('token/check','UserController@check')->middleware('auth-api:api');
    Route::post('client/check','UserController@checkClient')->middleware('check-client');
});


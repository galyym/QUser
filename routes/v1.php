<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;

Route::group(['prefix' => 'v2/{lang}', 'where' => ['lang' => '[kk,ru]{2}']], function () {

    Route::post('sign-in', \App\Qamtu\User\Actions\SignInAction::class);

    Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => 'jwt'], function () {
        Route::get('test', function (Request $request, $result){
            return response([
                'text' => $result,
                'data' => $request->all()
            ]);
        });
    });
});


Route::get('redis', function (Request $request){
    $redis = Redis::connection();
    $redis->set('lara_key', 'Example');
    return response('success');
});

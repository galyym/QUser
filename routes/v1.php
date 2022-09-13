<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;

Route::group(['prefix' => 'v2/{lang}', 'where' => ['lang' => '[kk,ru]{2}']], function () {
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::post('sign-in', \App\Qamtu\User\Actions\SignInAction::class);
    });
});


Route::get('redis', function (Request $request){
    $redis = Redis::connection();
    $redis->set('lara_key', 'Example');
    return response('success');
});

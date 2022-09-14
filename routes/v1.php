<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;

Route::group(['prefix' => 'v2/{lang}', 'where' => ['lang' => '[kk,ru]{2}']], function () {

    Route::post('sign-in', \App\Qamtu\User\Actions\SignInAction::class);

    Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => 'jwt'], function () {
        Route::post('request', \App\Qamtu\Request\Actions\SentRequestAction::class);
    });
});

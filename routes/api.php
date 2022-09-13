<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v2/{lang}', 'where' => ['lang' => '[kk,ru]{2}']], function () {
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('sign-in', \App\Qamtu\User\Actions\SignInAction::class);
    });
});

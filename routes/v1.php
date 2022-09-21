<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Qamtu\Resume\Action\ResumeListAction;
use App\Qamtu\Resume\Action\ResumeAddAction;
use App\Qamtu\Resume\Action\ResumeReadAction;
use App\Qamtu\Resume\Action\ResumeUpdateAction;
use App\Qamtu\Resume\Action\KatoListAction;

Route::group(['prefix' => 'v2/{lang}', 'where' => ['lang' => '[kk,ru]{2}']], function () {

    Route::post('sign-in', \App\Qamtu\User\Actions\SignInAction::class);

    Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => 'jwt'], function () {
        Route::post('request', \App\Qamtu\Request\Actions\SentRequestAction::class);

        //resume routes--------
        Route::get('resume', ResumeListAction::class);
        Route::get('resume/{id}', ResumeReadAction::class);
        Route::get('kato', KatoListAction::class);
        Route::post('resume', ResumeAddAction::class);
        Route::put('resume/{id}', ResumeUpdateAction::class);
        // --------------
    });
});

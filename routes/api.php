<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Qamtu\Resume\Action\ResumeListAction;
use App\Qamtu\Resume\Action\ResumeAddAction;
use App\Qamtu\Resume\Action\ResumeReadAction;
use App\Qamtu\Resume\Action\ResumeUpdateAction;
use App\Qamtu\Resume\Action\KatoListAction;



Route::group(['prefix' => 'v2/{lang}', 'where' => ['lang' => '[kk,ru]{2}']], function () {
    Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => 'jwt'], function () {
        Route::get('sign-in', \App\Qamtu\User\Actions\SignInAction::class);
        Route::get('test', function (){
            return response('success');
        });
    });
});

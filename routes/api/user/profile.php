<?php

use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'user',
    'namespace' => 'App\Http\Controllers\Api\User\profile'
], function () {
    Route::group(['prefix' => 'profile', 'middleware' => 'api.user.auth'], function () {
        Route::get('/', 'ProfileController@index');
        Route::put('/', 'ProfileController@update');
        Route::put('change-password', 'ChangePassController@update')->middleware('api.user.verify');
    });
});

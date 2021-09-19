<?php

use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'user',
    'namespace' => 'App\Http\Controllers\Api\User\Auth'
], function () {
    Route::group(['middleware' => 'api.guest'], function () {
        Route::post('/register', 'RegisteredUserController@store');
        Route::post('/login', 'AuthController@store');
        Route::post('/forgot-password', 'PasswordResetController@sendResetMail');
        Route::post('/reset-password', 'PasswordResetController@resetPass');
    });
    Route::group(['middleware' => 'api.user.auth'], function () {
        Route::group(['middleware' => 'protect.verify'], function () {
            Route::post('/verify-code', 'VerificationController@verify');
            Route::get('/send-code', 'VerificationController@sendCode');
        });
        Route::get('/logout', 'AuthController@destroy');
    });
});

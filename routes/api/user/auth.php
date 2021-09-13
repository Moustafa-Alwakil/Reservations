<?php

use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'user',
    'namespace' => 'App\Http\Controllers\Api\User\Auth'
], function () {
    Route::group(['middleware' => 'api.guest'], function () {
        Route::post('/register', 'RegisteredUserController@store');
        Route::get('/login', 'AuthenticatedSessionController@create');
        Route::post('/login', 'AuthenticatedSessionController@store');
        Route::get('/forgot-password', 'PasswordResetLinkController@create');
        Route::post('/forgot-password', 'PasswordResetLinkController@store');
        Route::get('/reset-password/{token}', 'NewPasswordController@create');
        Route::post('/reset-password', 'NewPasswordController@store');
    });
    Route::group(['middleware' => 'auth:web'], function () {
        Route::get('/verify-email', 'EmailVerificationPromptController@__invoke');
        Route::group(['middleware' => 'throttle:6,1'], function () {
            Route::get('/verify-email/{id}/{hash}', 'VerifyEmailController@__invoke')->middleware('signed');
            Route::post('/email/verification-notification', 'EmailVerificationNotificationController@store');
        });
        Route::get('/confirm-password', 'ConfirmablePasswordController@show');
        Route::post('/confirm-password', 'ConfirmablePasswordController@store');
        Route::post('/logout', 'AuthenticatedSessionController@destroy');
    });
});

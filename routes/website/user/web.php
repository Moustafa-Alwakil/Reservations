<?php

use Illuminate\Support\Facades\Route;



Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    'namespace' => 'App\Http\Controllers\Website\User'
], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::group(['namespace' => 'Auth'], function () {
            Route::group(['middleware' => 'guest'], function () {
                Route::get('/register', 'RegisteredUserController@create')->name('user.register');
                Route::post('/register', 'RegisteredUserController@store')->name('store.user.register');
                Route::get('/login', 'AuthenticatedSessionController@create')->name('user.login');
                Route::post('/login', 'AuthenticatedSessionController@store')->name('store.user.login');
                Route::get('/forgot-password', 'PasswordResetLinkController@create')->name('user.password.request');
                Route::post('/forgot-password', 'PasswordResetLinkController@store')->name('user.password.email');
                Route::get('/reset-password/{token}', 'NewPasswordController@create')->name('user.password.reset');
                Route::post('/reset-password', 'NewPasswordController@store')->name('user.password.update');
            });
            Route::group(['middleware' => 'auth:web'], function () {
                Route::get('/verify-email', 'EmailVerificationPromptController@__invoke')->name('user.verification.notice');
                Route::group(['middleware' => 'throttle:6,1'], function () {
                    Route::get('/verify-email/{id}/{hash}', 'VerifyEmailController@__invoke')->middleware('signed')->name('user.verification.verify');
                    Route::post('/email/verification-notification', 'EmailVerificationNotificationController@store')->name('user.verification.send');
                });
                Route::get('/confirm-password', 'ConfirmablePasswordController@show')->name('user.password.confirm');
                Route::post('/confirm-password', 'ConfirmablePasswordController@store');
                Route::post('/logout', 'AuthenticatedSessionController@destroy')->name('user.logout');
            });
        });
        Route::group(['prefix' => 'profile', 'middleware' => 'auth:web', 'namespace' => 'Profile'], function () {
            Route::get('/update', 'ProfileController@index')->name('user.profile');
            Route::post('/update', 'ProfileController@update')->name('user.profile.update');
            Route::get('/change-password', 'ChangePassController@index')->name('user.changepass');
            Route::post('/change-password', 'ChangePassController@update')->name('user.changepass.update');
        });
    });
});

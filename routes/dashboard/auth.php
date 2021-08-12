<?php

use Illuminate\Support\Facades\Route;



Route::group([
    'namespace' => 'App\Http\Controllers\Dashboard\Auth'
], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/register', 'RegisteredAdminController@create')->name('admin.register');
        Route::post('/register', 'RegisteredAdminController@store')->name('store.admin.register');
        Route::get('/login', 'AuthenticatedSessionController@create')->name('admin.login');
        Route::post('/login', 'AuthenticatedSessionController@store')->name('store.admin.login');
        Route::get('/forgot-password', 'PasswordResetLinkController@create')->name('admin.password.request');
        Route::post('/forgot-password', 'PasswordResetLinkController@store')->name('admin.password.email');
        Route::get('/reset-password/{token}', 'NewPasswordController@create')->name('admin.password.reset');
        Route::post('/reset-password', 'NewPasswordController@store')->name('admin.password.update');
    });
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/verify-email', 'EmailVerificationPromptController@__invoke')->name('admin.verification.notice');
        Route::group(['middleware' => 'throttle:6,1'], function () {
            Route::get('/verify-email/{id}/{hash}', 'VerifyEmailController@__invoke')->middleware('signed')->name('admin.verification.verify');
            Route::post('/email/verification-notification', 'EmailVerificationNotificationController@store')->name('admin.verification.send');
        });
        Route::get('/confirm-password', 'ConfirmablePasswordController@show')->name('admin.password.confirm');
        Route::post('/confirm-password', 'ConfirmablePasswordController@store');
        Route::post('/logout', 'AuthenticatedSessionController@destroy')->name('admin.logout');
    });
});

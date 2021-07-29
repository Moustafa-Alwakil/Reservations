<?php

use Illuminate\Support\Facades\Route;



Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    'namespace' => 'App\Http\Controllers\Website\Doctor\Auth'
], function () {
    Route::group(['prefix' => 'doctor'], function () {
        Route::group(['middleware' => 'guest'], function () {
            Route::get('/register', 'RegisteredDoctorController@create')->name('doctor.register');
            Route::post('/register', 'RegisteredDoctorController@store')->name('store.doctor.register');
            Route::get('/login', 'AuthenticatedSessionController@create')->name('doctor.login');
            Route::post('/login', 'AuthenticatedSessionController@store')->name('store.doctor.login');
            Route::get('/forgot-password', 'PasswordResetLinkController@create')->name('doctor.password.request');
            Route::post('/forgot-password', 'PasswordResetLinkController@store')->name('doctor.password.email');
            Route::get('/reset-password/{token}', 'NewPasswordController@create')->name('doctor.password.reset');
            Route::post('/reset-password', 'NewPasswordController@store')->name('doctor.password.update');
        });
        Route::group(['middleware' => 'auth:doc'], function () {
            Route::get('/verify-email', 'EmailVerificationPromptController@__invoke')->name('doctor.verification.notice');
            Route::group(['middleware' => 'throttle:6,1'], function () {
                Route::get('/verify-email/{id}/{hash}', 'VerifyEmailController@__invoke')->middleware('signed')->name('doctor.verification.verify');
                Route::post('/email/verification-notification', 'EmailVerificationNotificationController@store')->name('doctor.verification.send');
            });
            Route::get('/confirm-password', 'ConfirmablePasswordController@show')->name('doctor.password.confirm');
            Route::post('/confirm-password', 'ConfirmablePasswordController@store');
            Route::post('/logout', 'AuthenticatedSessionController@destroy')->name('doctor.logout');
        });
    });
});

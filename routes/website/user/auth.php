<?php


use Illuminate\Support\Facades\Route;






Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    'namespace' => 'App\Http\Controllers\Website\User'
], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::get('/register','RegisteredUserController@create')->middleware('guest')->name('user.register');
        Route::post('/register','RegisteredUserController@store')->middleware('guest');
        Route::get('/login','AuthenticatedSessionController@create')->middleware('guest')->name('user.login');
        Route::post('/login','AuthenticatedSessionController@store')->middleware('guest');
        Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->middleware('guest')->name('password.request');
        Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->middleware('guest')->name('password.email');
        Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->middleware('guest')->name('password.reset');
        Route::post('/reset-password', [NewPasswordController::class, 'store'])->middleware('guest')->name('password.update');
        Route::get('/verify-email','EmailVerificationPromptController@__invoke')->middleware('auth')->name('verification.notice');
        Route::get('/verify-email/{id}/{hash}','EmailVerificationPromptController@__invoke')->middleware(['auth', 'signed', 'throttle:6,1'])->name('verification.verify');
        Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');
        Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])->middleware('auth')->name('password.confirm');
        Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])->middleware('auth');
        Route::post('/logout','AuthenticatedSessionController@destroy')->middleware('auth')->name('user.logout');
    });
});

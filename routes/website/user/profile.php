<?php

use Illuminate\Support\Facades\Route;



Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    'namespace' => 'App\Http\Controllers\Website\User'
], function () {
        Route::group(['prefix' => 'user', 'middleware' => 'auth:web', 'namespace' => 'Profile'], function () {
            Route::get('/profile', 'ProfileController@index')->name('user.profile');
            Route::post('/profile', 'ProfileController@update')->name('user.profile.update');
            Route::get('/change-password', 'ChangePassController@index')->name('user.changepass');
            Route::post('/change-password', 'ChangePassController@update')->name('user.changepass.update');
        });
    });

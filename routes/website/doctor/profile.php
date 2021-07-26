<?php

use Illuminate\Support\Facades\Route;



Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    'namespace' => 'App\Http\Controllers\Website\Doctor'
], function () {
    Route::group(['prefix' => 'doctor', 'middleware' => 'auth:doc', 'namespace' => 'Profile'], function () {
        Route::get('/profile', 'ProfileController@index')->name('doctor.profile');
        Route::post('/profile', 'ProfileController@update')->name('doctor.profile.update');
        Route::get('/change-password', 'ChangePassController@index')->name('doctor.changepass');
        Route::post('/change-password', 'ChangePassController@update')->name('doctor.changepass.update');
    });
});

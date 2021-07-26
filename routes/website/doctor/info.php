<?php

use Illuminate\Support\Facades\Route;



Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    'namespace' => 'App\Http\Controllers\Website\Doctor'
], function () {
    Route::group(['prefix' => 'doctor', 'middleware' => 'auth:doc', 'namespace' => 'Info'], function () {
        Route::get('/info', 'InfoController@index')->name('doctor.info');
        Route::post('/info', 'InfoController@store')->name('doctor.info.store');
        Route::put('/info', 'InfoController@update')->name('doctor.info.update');
    });
});
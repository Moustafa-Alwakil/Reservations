<?php

use Illuminate\Support\Facades\Route;





Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    'namespace' => 'App\Http\Controllers\Website\Doctor'
], function () {
    Route::group(['prefix' => 'doctor', 'middleware' => ['auth:doc', 'doc.verified', 'doc.accepted'], 'namespace' => 'Exception'], function () {
        Route::post('/exception', 'ExceptionController@store')->name('exception.store');
        Route::post('/exception/destroy', 'ExceptionController@destroy')->name('exception.destroy');
    });
});
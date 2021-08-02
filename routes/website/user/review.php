<?php

use Illuminate\Support\Facades\Route;



Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    'namespace' => 'App\Http\Controllers\Website\User'
], function () {
        Route::group(['prefix' => 'review', 'middleware' => 'auth:web', 'namespace' => 'Review'], function () {
            Route::post('add', 'ReviewController@store')->name('review.store');
        });
    });
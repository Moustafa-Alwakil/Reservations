<?php

use Illuminate\Support\Facades\Route;



Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    'namespace' => 'App\Http\Controllers\Website\User'
], function () {
        Route::group(['prefix' => 'appointment', 'middleware' => 'auth:web', 'namespace' => 'Appointment'], function () {
            Route::get('all', 'AppointmentController@index')->name('appointment.index');
            Route::get('create/{id}', 'AppointmentController@create')->name('appointment.create');
            Route::post('create', 'AppointmentController@store')->name('appointment.store');
            Route::post('update', 'AppointmentController@update')->name('appointment.update');
        });
    });
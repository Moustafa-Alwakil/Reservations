<?php

use Illuminate\Support\Facades\Route;



Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    'namespace' => 'App\Http\Controllers\Website\Doctor'
], function () {
    Route::group(['prefix' => 'doctor', 'middleware' => ['auth:doc', 'doc.verified', 'doc.accepted'], 'namespace' => 'Experience'], function () {
        Route::get('/experience', 'ExperienceController@index')->name('doctor.experience');
        Route::post('/experience', 'ExperienceController@store')->name('doctor.experience.store');
        Route::get('/experience/{id}', 'ExperienceController@edit')->name('doctor.experience.edit');
        Route::put('/experience', 'ExperienceController@update')->name('doctor.experience.update');
        Route::delete('/experience', 'ExperienceController@destroy')->name('doctor.experience.destroy');
    });
});

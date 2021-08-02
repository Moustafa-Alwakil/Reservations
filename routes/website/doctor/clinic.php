<?php

use Illuminate\Support\Facades\Route;





Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    'namespace' => 'App\Http\Controllers\Website\Doctor'
], function () {
    Route::group(['prefix' => 'doctor', 'middleware' => ['auth:doc', 'doc.verified', 'doc.accepted'], 'namespace' => 'Clinic'], function () {
        Route::resource('clinics', 'ClinicController');
        Route::get('clinics/create/getregions/{id}', 'ClinicController@getRegions');
        Route::get('clinics/edit/photo/destroy/{id}', 'ClinicController@destroyClinicPhoto')->name('clinic.destroyphoto');
        Route::get('clinics/'. session()->pull('clinic_id').'/edit/getregions/{id}', 'ClinicController@getRegions');
    });
});

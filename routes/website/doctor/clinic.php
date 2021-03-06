<?php

use Illuminate\Support\Facades\Route;





Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    'namespace' => 'App\Http\Controllers\Website\Doctor'
], function () {
    Route::group(['prefix' => 'doctor', 'middleware' => ['auth:doc', 'doc.verified', 'doc.accepted'], 'namespace' => 'Clinic'], function () {
        Route::resource('clinics', 'ClinicController');
        Route::get('clinics/create/getregions/{id}', 'ClinicController@getRegion');
        Route::get('clinics/edit/photo/destroy/{id}', 'ClinicController@destroyClinicPhoto')->name('clinic.destroyphoto');
        Route::get('clinics/edit/getregions/{clinic}/{id}', 'ClinicController@getRegions');
    });
});

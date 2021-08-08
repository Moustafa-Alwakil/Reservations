<?php

use Illuminate\Support\Facades\Route;



Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath',],
    'namespace' => 'App\Http\Controllers\Website'
], function () {
    Route::get('/', 'IndexController@index')->name('index');
    Route::get('/clinics', 'IndexController@allClinics')->name('all.clinics');
    Route::get('/clinics/search', 'IndexController@showClinicsByLocation')->name('show.clinics.bylocation');
    Route::get('/clinics/search/filter', 'IndexController@clinicsFilter')->name('clinics.filter');
    Route::get('/clinic/{id}', 'IndexController@clinic')->name('clinic');
    Route::get('getregions/{id}', 'IndexController@getRegions');
    Route::get('/terms', 'IndexController@terms')->name('terms');
    Route::get('/policy', 'IndexController@policy')->name('policy');
});

require __DIR__ . '/user/auth.php';
require __DIR__ . '/doctor/auth.php';

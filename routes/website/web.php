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
    Route::get('/clinic/{id}', 'IndexController@clinic')->name('clinic');
    Route::get('getregions/{id}', 'IndexController@getRegions');
});

require __DIR__ . '/user/auth.php';
require __DIR__ . '/doctor/auth.php';

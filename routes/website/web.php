<?php

use Illuminate\Support\Facades\Route;



Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath',],
    'namespace' => 'App\Http\Controllers\Website'
], function () {
    Route::get('/', 'IndexController@index')->name('index');
    Route::get('/clinics', 'IndexController@allClinics')->name('all.clinics');
    Route::get('/clinic/{id}', 'IndexController@clinic')->name('clinic');
});

require __DIR__ . '/user/auth.php';
require __DIR__ . '/doctor/auth.php';

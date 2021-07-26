<?php

use Illuminate\Support\Facades\Route;



Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    'namespace' => 'App\Http\Controllers\Website\Doctor'
], function () {
    Route::group(['prefix' => 'doctor', 'middleware' => ['auth:doc', 'doc.verified', 'doc.accepted'], 'namespace' => 'Certificate'], function () {
        Route::get('/certificate', 'CertificateController@index')->name('doctor.certificate');
        Route::post('/certificate', 'CertificateController@store')->name('doctor.certificate.store');
        Route::delete('/certificate', 'CertificateController@destroy')->name('doctor.certificate.destroy');
    });
});

<?php

use Illuminate\Support\Facades\Route;



Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    'namespace' => 'App\Http\Controllers\Website\Doctor'
], function () {
    Route::group(['prefix' => 'doctor'], function () {
        Route::group(['prefix' => 'profile', 'middleware' => 'auth:doc', 'namespace' => 'Profile'], function () {
            Route::get('/update', 'ProfileController@index')->name('doctor.profile');
            Route::post('/update', 'ProfileController@update')->name('doctor.profile.update');
            Route::get('/change-password', 'ChangePassController@index')->name('doctor.changepass');
            Route::post('/change-password', 'ChangePassController@update')->name('doctor.changepass.update');
            Route::get('/info', 'InfoController@index')->name('doctor.info');
            Route::post('/info', 'InfoController@store')->name('doctor.info.store');
            Route::put('/info', 'InfoController@update')->name('doctor.info.update');
            Route::group(['middleware'=>'doc.verified'],function(){
                Route::get('/certificate','CertificateController@index')->name('doctor.certificate');
                Route::post('/certificate','CertificateController@store')->name('doctor.certificate.store');
                Route::delete('/certificate','CertificateController@destroy')->name('doctor.certificate.destroy');
                Route::get('/experience','ExperienceController@index')->name('doctor.experience');
                Route::post('/experience','ExperienceController@store')->name('doctor.experience.store');
                Route::get('/experience/{id}','ExperienceController@edit')->name('doctor.experience.edit');
                Route::put('/experience','ExperienceController@update')->name('doctor.experience.update');
                Route::delete('/experience','ExperienceController@destroy')->name('doctor.experience.destroy');
            });
        });
    });
});

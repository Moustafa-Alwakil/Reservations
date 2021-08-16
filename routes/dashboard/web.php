<?php

use Illuminate\Support\Facades\Route;



Route::group([
    'namespace' => 'App\Http\Controllers\Dashboard',
    'middleware'=>['auth:admin','admin.verified'],
], function () {
    Route::get('/', 'IndexController@index')->name('admin.index');
    Route::resource('addresses', 'Address\AddressController');
    Route::get('addresses/getregions/{id}', 'Address\AddressController@getRegion');
    Route::get('addresses/edit/getregions/{address}/{id}', 'Address\AddressController@getRegions');
    Route::resource('appointments', 'Appointment\AppointmentController');
    Route::resource('certificates', 'Certificate\CertificateController');
    Route::resource('cities', 'City\CityController');
    Route::resource('departments', 'Department\DepartmentController');
    Route::resource('examfees', 'Examfee\ExamfeeController');
    Route::get('examfees/getclinics/{id}', 'Examfee\ExamfeeController@getClinic');
    Route::get('examfees/edit/getclinics/{examfee}/{id}', 'Examfee\ExamfeeController@getClinics');
    Route::resource('clinicphotos', 'ClinicPhoto\ClinicPhotoController');
    Route::get('clinicphotos/getclinics/{id}', 'ClinicPhoto\ClinicPhotoController@getClinic');
    Route::get('clinicphotos/edit/getclinics/{clinicphoto}/{id}', 'ClinicPhoto\ClinicPhotoController@getClinics');
    Route::resource('exceptions', 'Exception\ExceptionController');
    Route::get('exceptions/getclinics/{id}', 'Exception\ExceptionController@getClinic');
    Route::get('exceptions/edit/getclinics/{clinicphoto}/{id}', 'Exception\ExceptionController@getClinics');
    Route::resource('experiences', 'Experience\ExperienceController');
});

require __DIR__ . '/auth.php';
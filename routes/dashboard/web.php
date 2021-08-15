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
});

require __DIR__ . '/auth.php';
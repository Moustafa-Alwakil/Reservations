<?php

use Illuminate\Support\Facades\Route;



Route::group([
    'namespace' => 'App\Http\Controllers\Dashboard',
    'middleware'=>['auth:admin','admin.verified'],
], function () {
    Route::get('/', 'IndexController@index')->name('admin.index');
    Route::post('/', 'IndexController@updateDoctorStatus')->name('doctor.accept');
    Route::post('/clinic', 'IndexController@updateClinicStatus')->name('clinic.accept');
    Route::resource('addresses', 'Address\AddressController');
    Route::get('addresses/getregions/{id}', 'Address\AddressController@getRegion');
    Route::get('addresses/edit/getregions/{address}/{id}', 'Address\AddressController@getRegions');
    Route::get('addresses/getclinics/{id}', 'Address\AddressController@getClinic');
    Route::get('addresses/edit/getclinics/{address}/{id}', 'Address\AddressController@getClinics');
    Route::resource('appointments', 'Appointment\AppointmentController');
    Route::get('appointments/getclinics/{id}', 'Appointment\AppointmentController@getClinic');
    Route::get('appointments/edit/getclinics/{appointment}/{id}', 'Appointment\AppointmentController@getClinics');
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
    Route::get('exceptions/edit/getclinics/{exception}/{id}', 'Exception\ExceptionController@getClinics');
    Route::resource('experiences', 'Experience\ExperienceController');
    Route::resource('infos', 'Info\InfoController');
    Route::resource('regions', 'Region\RegionController');
    Route::resource('workdays', 'Workday\WorkdayController');
    Route::get('workdays/getclinics/{id}', 'Workday\WorkdayController@getClinic');
    Route::get('workdays/edit/getclinics/{workday}/{id}', 'Workday\WorkdayController@getClinics');
    Route::resource('services', 'Service\ServiceController');
    Route::resource('reviews', 'Review\ReviewController');
    Route::resource('clinicservices', 'ClinicService\ClinicServiceController');
    Route::get('clinicservices/getclinics/{id}', 'ClinicService\ClinicServiceController@getClinic');
    Route::get('clinicservices/edit/getclinics/{clinicservice}/{id}', 'ClinicService\ClinicServiceController@getClinics');
    Route::get('clinicservices/getservices/{id}', 'ClinicService\ClinicServiceController@getService');
    Route::get('clinicservices/edit/getservices/{clinicservice}/{id}', 'ClinicService\ClinicServiceController@getServices');
    Route::resource('users', 'User\UserController');
    Route::resource('doctors', 'Doctor\DoctorController');
    Route::resource('adminclinics', 'Clinic\ClinicController');
    Route::resource('roles', 'Role\RoleController');
    Route::resource('permissions', 'Permission\PermissionController');
    Route::group([
        'prefix' => 'rolespermissions',
    ], function () {
        Route::get('/', 'RolePermission\RolePermissionController@index')->name('rolespermissions.index');
        Route::get('create', 'RolePermission\RolePermissionController@create')->name('rolespermissions.create');
        Route::post('/', 'RolePermission\RolePermissionController@store')->name('rolespermissions.store');
        Route::get('{role_id}/{permission_id}/edit', 'RolePermission\RolePermissionController@edit')->name('rolespermissions.edit');
        Route::put('{role_id}/{permission_id}/edit', 'RolePermission\RolePermissionController@update')->name('rolespermissions.update');
        Route::delete('{role_id}/{permission_id}', 'RolePermission\RolePermissionController@destroy')->name('rolespermissions.destroy');
    });
    Route::group([
        'prefix' => 'modelsroles',
    ], function () {
        Route::get('/', 'ModelRole\ModelRoleController@index')->name('modelsroles.index');
        Route::get('create', 'ModelRole\ModelRoleController@create')->name('modelsroles.create');
        Route::post('/', 'ModelRole\ModelRoleController@store')->name('modelsroles.store');
        Route::delete('{role_name}/{model_id}', 'ModelRole\ModelRoleController@destroy')->name('modelsroles.destroy');
    });
    Route::group([
        'prefix' => 'modelspermissions',
    ], function () {
        Route::get('/', 'ModelPermission\ModelPermissionController@index')->name('modelspermissions.index');
        Route::get('create', 'ModelPermission\ModelPermissionController@create')->name('modelspermissions.create');
        Route::post('/', 'ModelPermission\ModelPermissionController@store')->name('modelspermissions.store');
        Route::delete('{permission_id}/{model_id}', 'ModelPermission\ModelPermissionController@destroy')->name('modelspermissions.destroy');
    });
});

require __DIR__ . '/auth.php';
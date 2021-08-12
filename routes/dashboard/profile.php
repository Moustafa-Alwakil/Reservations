<?php

use Illuminate\Support\Facades\Route;



Route::group([
    'prefix'=> 'profile',
    'namespace' => 'App\Http\Controllers\Dashboard\Profile',
    'middleware'=>['auth:admin'],
], function () {
    Route::get('/', 'ProfileController@create')->name('admin.profile');
    Route::post('/', 'ProfileController@update')->name('admin.profile.update');
    Route::get('/change-password', 'ChangePassController@create')->name('admin.changepass');
    Route::post('/change-password', 'ChangePassController@update')->name('admin.changepass.update');
});
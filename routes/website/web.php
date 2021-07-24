<?php

use Illuminate\Support\Facades\Route;



Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath',],
    'namespace' => 'App\Http\Controllers\Website'
], function () {
    Route::get('/', 'IndexController@index')->name('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/user/auth.php';
require __DIR__ . '/doctor/auth.php';

<?php

use Illuminate\Support\Facades\Route;



Route::group([
    'namespace' => 'App\Http\Controllers\Dashboard',
    'middleware'=>['auth:admin','admin.verified'],
], function () {
    Route::get('/', 'IndexController@index')->name('admin.index');
});

require __DIR__ . '/auth.php';
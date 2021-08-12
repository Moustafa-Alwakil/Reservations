<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if(Request::is('*/user/*')||Request::is('*/user')||Request::is('user/*')||Request::is('user')){
            if (! $request->expectsJson()) {
                return route('user.login');
            }
        }
        if(Request::is('*/doctor/*')||Request::is('*/doctor')||Request::is('doctor/*')||Request::is('doctor')){
            if (! $request->expectsJson()) {
                return route('doctor.login');
            }
        }
        if(Request::is('*/admin/*')||Request::is('*/admin')||Request::is('admin/*')||Request::is('admin')){
            if (! $request->expectsJson()) {
                return route('admin.login');
            }
        }
    }
}

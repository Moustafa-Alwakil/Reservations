<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class EnsureDocIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $redirectToRoute = null)
    {
        if (!Auth::guard('doc')->user()->email_verified_at) {
            return $request->expectsJson()
                ? abort(403, 'Your email address is not verified.')
                : Redirect::guest(URL::route($redirectToRoute ?: 'doctor.profile'));
        }
        if (Auth::guard('doc')->user()->status == 0) {
            return $request->expectsJson()
                ? abort(403, 'Your license hasn\'t been accepted yet.')
                : Redirect::guest(URL::route($redirectToRoute ?: 'doctor.info'));
        }
        return $next($request);
    }
}

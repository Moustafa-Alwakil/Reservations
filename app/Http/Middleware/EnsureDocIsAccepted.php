<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class EnsureDocIsAccepted
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
        if (Auth::guard('doc')->user()->status == 2) {
            return $request->expectsJson()
                ? abort(403, 'Your information is being reviewed by us and we will verify you as soon as possible, this might take hours or maybe few days.')
                : Redirect::guest(URL::route($redirectToRoute ?: 'doctor.info'));
        }
        if (Auth::guard('doc')->user()->status == 0) {
            return $request->expectsJson()
                ? abort(403, 'Your information is invalid, please review it again and insert the correct information.')
                : Redirect::guest(URL::route($redirectToRoute ?: 'doctor.info'));
        }
        return $next($request);
    }
}

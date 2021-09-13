<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Traits\apiResourceTrait;
use Illuminate\Support\Facades\Auth;

class checkGuest
{
    use apiResourceTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('api')->check()) {
            return $this->returnError('Invalid Request', 400);
        }

        if (Auth::guard('doc-api')->check()) {
            return $this->returnError('Invalid Request', 400);
        }

        return $next($request);
    }
}

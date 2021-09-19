<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Traits\apiResourceTrait;

class DoctorCheckAuth
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
        
        if (auth('doc-api')->check())
            return $next($request);

        return $this->returnError('Unauthorized Doctor', 401);
    }
}

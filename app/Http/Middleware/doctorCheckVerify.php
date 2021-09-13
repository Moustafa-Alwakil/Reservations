<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Traits;
use App\Traits\apiResourceTrait;

class doctorCheckVerify
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

        if(auth('doc-api')->check()){

            if(!auth('doc-api')->user()->email_verified_at){
                return $this->returnError('Unverified Doctor Account',401);
            }

            return $next($request);
        }

        return $this->returnError('unauthorized Doctor',401);
    }
}

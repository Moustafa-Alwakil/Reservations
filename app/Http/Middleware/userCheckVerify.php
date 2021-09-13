<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Traits\apiResourceTrait;

class userCheckVerify
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
        if(auth('api')->check()){

            if(!auth('api')->user()->email_verified_at){
                return $this->returnError('Unverified User Account',401);
            }

            return $next($request);
        }

        return $this->returnError('unauthorized User',401);
    }
}

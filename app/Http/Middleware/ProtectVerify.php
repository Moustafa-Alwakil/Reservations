<?php

namespace App\Http\Middleware;

use App\Models\Physican;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use App\Traits\apiResourceTrait;

class ProtectVerify
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
        if (auth('api')->check()) {

            $user = User::select('email_verified_at')->where('id', auth('api')->user()->id)->first();

            if (!$user->email_verified_at)
                return $next($request);

            return $this->returnError('You have been already verified your account!');
        } elseif (auth('doc-api')->check()) {

            $doctor = Physican::select('email_verified_at')->where('id', auth('doc-api')->user()->id)->first();

            if (!$doctor->email_verified_at)
                return $next($request);

            return $this->returnError('You have been already verified your account!');
        }

        return $this->returnError('Unauthorized action', 401);
    }
}

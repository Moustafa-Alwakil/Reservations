<?php

namespace App\Http\Controllers\Website\User\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
        /**
     * Send a new email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::INDEX);
        }
        $request->user()->sendEmailVerificationNotification();

        return back()->with('success', 'Verification link sent successfully, please check your email inbox');
    }
}

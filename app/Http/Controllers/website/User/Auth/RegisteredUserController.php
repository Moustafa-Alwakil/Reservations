<?php

namespace App\Http\Controllers\Website\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\website\user\Auth\StoreRegisterRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('website.user.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(StoreRegisterRequest $request)
    {
        // convert the request to the form which fits the table
        $request['name'] = $request->only('fname', 'lname');
        $data = $request->except('_token', 'fname', 'lname', 'password_confirmation');

        // insert the user registered data to the users table
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phone' => $data['phone'],
            'gender' => $data['gender'],
            'birthdate' => $data['birthdate'],
        ]);

        // check if the insertation process failed
        // if not then complete the register process
        if (!$user)
            return redirect()->route('user.register')->with('error', __('website\includes\sessionDisplay.wrong'));

        Auth::guard('web')->login($user);

        event(new Registered($user));


        return redirect(RouteServiceProvider::INDEX);
    }
}

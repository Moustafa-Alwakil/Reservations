<?php

namespace App\Http\Controllers\Website\Doctor\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\website\user\StoreRegisterRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('website.doctor.register');
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
        // make validation on request using StoreRegisterRequest rules
        $request->validated();

        // convert the request to the form which fits the table
        $request['name'] = $request->only('fname', 'lname');
        $data = $request->except('_token', 'fname', 'lname', 'confirmation_password');
        
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
        if(!$user)
            return redirect()->route('user.regiser')->with('error','Something went wrong, Please try again');

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::INDEX);
    }
}

<?php

namespace App\Http\Controllers\Website\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\website\user\StoreRegisterRequest;
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
        return view('website.user.register');
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
        $request->validated();
        $request['name'] = $request->only('fname', 'lname');
        $data = $request->except('_token', 'fname', 'lname', 'confirmation_password');
        
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phone' => $data['phone'],
            'gender' => $data['gender'],
            'birthdate' => $data['birthdate'],
        ]);
        if(!$user)
            return redirect()->route('user.regiser')->with('error','Something went wrong, Please try again');

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::INDEX);
    }
}

<?php

namespace App\Http\Controllers\Website\Doctor\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Doctor\Auth\StoreRegisterRequest;
use App\Models\Physican;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class RegisteredDoctorController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('website.doctor.auth.register');
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
        $request['name'] = $request->only('fname_ar', 'lname_ar', 'fname_en', 'lname_en');
        $data = $request->except('_token', 'fname_ar', 'lname_ar', 'fname_en', 'lname_en', 'password_confirmation');
        // insert the user registered data to the users table

        $doctor = Physican::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'gender' => $data['gender'],
            'birthdate' => $data['birthdate'],
        ]);

        // check if the insertation process failed
        // if not then complete the register process
        if (!$doctor)
            return redirect()->route('doctor.register')->with('error', 'Something went wrong, Please try again');

        Auth::guard('doc')->login($doctor);

        $doctor->sendEmailVerificationNotification();

        return redirect(RouteServiceProvider::INDEX);
    }
}

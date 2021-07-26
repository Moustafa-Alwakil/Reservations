<?php

namespace App\Http\Controllers\Website\Doctor\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\website\Doctor\Profile\UpdateProfileRequest;
use App\Models\Physican;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        // get the user from database
        $doctor = Physican::select('name', 'email', 'birthdate', 'gender', 'email_verified_at')->where('id', Auth::guard('doc')->user()->id)->first();
        // return to the view with user data
        return view('website.doctor.profile.index', compact('doctor'));
    }
    public function update(UpdateProfileRequest $request)
    {
        // make validation on request using UpdateProfileRequest rules
        $request->validated();
        
        // convert the request to the form which fits the table
        $request['name'] = $request->only('fname_ar', 'lname_ar','fname_en', 'lname_en');
        $data = $request->except('_token', 'fname_ar', 'lname_ar','fname_en', 'lname_en');
        // check if user updating the email
        // if not then update on user data
        if (!($data['email'] == Auth::guard('doc')->user()->email)) {

            // removing the verification from the account then update on user data
            $data['email_verified_at'] = null;
            $store = Physican::where('id', Auth::guard('doc')->user()->id)->update($data);

            // check if the updation process success
            // if not then redierct with error messgae
            if ($store) {

                // get the doctor data to pass it in sending email function
                $doctor = Physican::where('id', Auth::guard('doc')->user()->id)->first();
                $doctor->sendEmailVerificationNotification();
            }

            // check if the updation process failed
            // if not then redierct with success messgae
            if (!$store)
                return redirect()->route('doctor.profile')->with('error', 'Something went wrong, Please try again');

            return redirect()->route('doctor.profile')->with('success', 'Successfuly Updated');
        } else {
            $store = Physican::where('id', Auth::guard('doc')->user()->id)->update($data);

            // check if the updation process success
            // if not then redierct with error messgae
            if (!$store)
                return redirect()->route('doctor.profile')->with('error', 'Something went wrong, Please try again');

            return redirect()->route('doctor.profile')->with('success', 'Successfuly Updated');
        }
    }
}

<?php

namespace App\Http\Controllers\Website\User\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\website\user\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        // get the user from database
        $user = User::select('name', 'email', 'birthdate', 'gender', 'phone', 'email_verified_at')->where('id', Auth::guard('web')->user()->id)->get();
        $user = $user[0];

        // return to the view with user data
        return view('website.user.profile', compact('user'));
    }
    public function Update(UpdateProfileRequest $request)
    {
        // make validation on request using UpdateProfileRequest rules
        $request->validated();

        // convert the request to the form which fits the table
        $request['name'] = $request->only('fname', 'lname');
        $data = $request->except('_token', 'fname', 'lname');

        // check if user updating the email
        // if not then update on user data
        if (!($data['email'] == Auth::guard('web')->user()->email)) {

            // removing the verification from the account then update on user data
            $data['email_verified_at'] = null;
            $store = User::where('id', Auth::guard('web')->user()->id)->update($data);

            // check if the updation process success
            // if not then redierct with error messgae
            if ($store) {

                // get the user data to pass it in sending email function
                $user = User::where('id', Auth::guard('web')->user()->id)->first();
                $user->sendEmailVerificationNotification();
            }

            // check if the updation process failed
            // if not then redierct with success messgae
            if (!$store)
                return redirect()->route('user.profile')->with('error', 'Something went wrong, Please try again');

            return redirect()->route('user.profile')->with('success', 'Successfuly Updated');
        } else {
            $store = User::where('id', Auth::guard('web')->user()->id)->update($data);

            // check if the updation process success
            // if not then redierct with error messgae
            if (!$store)
                return redirect()->route('user.profile')->with('error', 'Something went wrong, Please try again');

            return redirect()->route('user.profile')->with('success', 'Successfuly Updated');
        }
    }
}

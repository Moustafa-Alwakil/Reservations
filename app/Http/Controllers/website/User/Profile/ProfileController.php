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
        $user = User::select('name', 'email', 'birthdate', 'gender', 'phone', 'email_verified_at')->where('id', Auth::guard('web')->user()->id)->get();
        $user = $user[0];
        return view('website.user.profile', compact('user'));
    }
    public function Update(UpdateProfileRequest $request)
    {
        $request->validated();
        $request['name'] = $request->only('fname', 'lname');
        $data = $request->except('_token', 'fname', 'lname');
        if (!($data['email'] == Auth::guard('web')->user()->email)) {
            $data['email_verified_at'] = null;
            $store = User::where('id', Auth::guard('web')->user()->id)->update($data);
            $user = User::where('id', Auth::guard('web')->user()->id)->first();
            $user->sendEmailVerificationNotification();
            if (!$store) {
                return redirect()->route('user.profile')->with('error', 'Something went wrong, Please try again');
            }
            return redirect()->route('user.profile')->with('success', 'Successfuly Updated');
        } else {
            $store = User::where('id', Auth::guard('web')->user()->id)->update($data);
            if (!$store) {
                return redirect()->route('user.profile')->with('error', 'Something went wrong, Please try again');
            }
            return redirect()->route('user.profile')->with('success', 'Successfuly Updated');
        }
    }
}

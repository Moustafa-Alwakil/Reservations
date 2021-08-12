<?php

namespace App\Http\Controllers\Dashboard\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Profile\UpdateProfileRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function create()
    {
        return view('dashboard.profile.profile');
    }

    public function update(UpdateProfileRequest $request)
    {
        if (!($request->email == Auth::guard('admin')->user()->email)) {

            $store = Admin::where('id', Auth::guard('admin')->user()->id)->update([
                'email' => $request->email,
                'email_verified_at' => null,
            ]);

            // check if the updation process success
            // if not then redierct with error messgae
            if ($store) {

                // get the user data to pass it in sending email function
                $admin = Admin::where('id', Auth::guard('admin')->user()->id)->first();
                $admin->sendEmailVerificationNotification();
            }
            if (!$store)
                return redirect()->route('admin.profile')->with('error', __('website\includes\sessionDisplay.wrong'));

            return redirect()->route('admin.profile')->with('success', __('website\includes\sessionDisplay.successupdate'));
        } else {
            $store = Admin::where('id', Auth::guard('admin')->user()->id)->update([
                'name' => $request->name,
            ]);

            // check if the updation process success
            // if not then redierct with error messgae
            if (!$store)
                return redirect()->route('admin.profile')->with('error', __('website\includes\sessionDisplay.wrong'));

            return redirect()->route('admin.profile')->with('success', __('website\includes\sessionDisplay.successupdate'));
        }
    }
}

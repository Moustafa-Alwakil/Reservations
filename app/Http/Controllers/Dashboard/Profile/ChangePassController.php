<?php

namespace App\Http\Controllers\Dashboard\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Profile\UpdatePassRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePassController extends Controller
{
    public function create()
    {
        return view('dashboard.profile.changePass');
    }

    public function update(UpdatePassRequest $request)
    {
        // getting the hashed password from the session
        $hashedPass = Auth::guard('admin')->user()->password;

        // check if the old password = hashed password which exists in the session
        // if not then redierct with error messgae
        if (Hash::check($request->oldpassword, $hashedPass)) {

            // check if the new password isn't the same old password
            // if not then redierct with error messgae
            if (!Hash::check($request->password, $hashedPass)) {

                // updating the user password after encrypting it
                $admin = Admin::find(Auth::guard('admin')->user()->id);
                $admin->password = bcrypt($request->password);
                $admin->save();

                // check if the password updation process failed 
                // if not then redierct with success messgae
                if (!$admin)
                    return redirect()->route('admin.changepass')->with('error', __('website\includes\sessionDisplay.wrong'));

                return redirect()->route('admin.changepass')->with('success', __('website\includes\sessionDisplay.successpass'));
            } else
                return redirect()->route('admin.changepass')->with('error', __('website\includes\sessionDisplay.newpass'));
        } else
            return redirect()->route('admin.changepass')->with('error', __('website\includes\sessionDisplay.oldpass'));
    }
}

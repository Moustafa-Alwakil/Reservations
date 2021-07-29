<?php

namespace App\Http\Controllers\Website\Doctor\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\website\UpdatePassRequest;
use App\Models\Physican;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ChangePassController extends Controller
{
    public function index()
    {
        // return url('en/doctor/profile/change-password');
        return view('website.changePass');
    }
    public function update(UpdatePassRequest $request)
    {
        // getting the hashed password from the session
        $hashedPass = Auth::guard('doc')->user()->password;

        // check if the old password = hashed password which exists in the session
        // if not then redierct with error messgae
        if (Hash::check($request->oldpassword, $hashedPass)) {

            // check if the new password isn't the same old password
            // if not then redierct with error messgae
            if (!Hash::check($request->password, $hashedPass)) {

                // updating the doctor password after encrypting it
                $doctor = Physican::find(Auth::guard('doc')->user()->id);
                $doctor->password = bcrypt($request->password);
                $doctor->save();

                // check if the password updation process failed 
                // if not then redierct with success messgae
                if (!$doctor)
                    return redirect()->route('doctor.changepass')->with('error', 'Something went wrong, Please try again');

                return redirect()->route('doctor.changepass')->with('success', 'You have Successfully changed Your password');
            } else
                return redirect()->route('doctor.changepass')->with('error', 'New password can not be the old password!');
        } else
            return redirect()->route('doctor.changepass')->with('error', 'The old password is not correct');
    }
}

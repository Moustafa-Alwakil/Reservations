<?php

namespace App\Http\Controllers\Website\User\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\website\UpdatePassRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ChangePassController extends Controller
{
    public function index()
    {
        return view('website.changePass');
    }
    public function update(UpdatePassRequest $request)
    {
        // getting the hashed password from the session
        $hashedPass = Auth::guard('web')->user()->password;

        // check if the old password = hashed password which exists in the session
        // if not then redierct with error messgae
        if (Hash::check($request->oldpassword, $hashedPass)) {

            // check if the new password isn't the same old password
            // if not then redierct with error messgae
            if (!Hash::check($request->password, $hashedPass)) {

                // updating the user password after encrypting it
                $user = User::find(Auth::guard('web')->user()->id);
                $user->password = bcrypt($request->password);
                $user->save();

                // check if the password updation process failed 
                // if not then redierct with success messgae
                if (!$user)
                    return redirect()->route('user.changepass')->with('error', __('website\includes\sessionDisplay.wrong'));

                return redirect()->route('user.changepass')->with('success', __('website\includes\sessionDisplay.successpass'));
            } else
                return redirect()->route('user.changepass')->with('error', __('website\includes\sessionDisplay.newpass'));
        } else
            return redirect()->route('user.changepass')->with('error', __('website\includes\sessionDisplay.oldpass'));
    }
}

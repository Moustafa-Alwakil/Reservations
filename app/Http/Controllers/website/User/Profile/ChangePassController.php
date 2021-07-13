<?php

namespace App\Http\Controllers\Website\User\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\website\user\UpdatePassRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ChangePassController extends Controller
{
    public function index()
    {
        return view('website.user.changePass');
    }
    public function update(UpdatePassRequest $request)
    {
        $request->validated();
        $hashedPass = Auth::guard('web')->user()->password;
        if (Hash::check($request->oldpassword, $hashedPass)) {
            if (!Hash::check($request->password, $hashedPass)) {
                $user = User::find(Auth::guard('web')->user()->id);
                $user->password = bcrypt($request->password);
                $user->save();
                if (!$user)
                    return redirect()->route('user.changepass')->with('error', 'Something went wrong, Please try again');
                return redirect()->route('user.changepass')->with('success', 'You have Successfully changed Your password');
            } else
                return redirect()->route('user.changepass')->with('error', 'New password can not be the old password!');
        } else
            return redirect()->route('user.changepass')->with('error', 'The old password is not correct');
    }
}

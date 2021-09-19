<?php

namespace App\Http\Controllers\Api\User\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\apiResourceTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class ChangePassController extends Controller
{

    use apiResourceTrait;

    public function update(Request $request)
    {
        $rules = [
            'oldpassword' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            'password' => ['required', 'confirmed', Rules\Password::defaults(), 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
            return $this->returnValidationError($validator);

        $hashedPass = auth('api')->user()->password;

        if (Hash::check($request->oldpassword, $hashedPass)) {

            if (!Hash::check($request->password, $hashedPass)) {

                $user = User::find(auth('api')->user()->id);
                $user->password = bcrypt($request->password);
                $user->save();

                if (!$user)
                    return $this->returnError('Something went wrong, please try again');

                return $this->returnSuccessMessage('You have been cahnged your password successfully');
            } else
                return $this->returnError('New password can not be the old password!');
        } else
            return $this->returnError('The old password is not correct');
    }
}

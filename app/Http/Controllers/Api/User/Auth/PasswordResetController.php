<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Http\Controllers\Controller;
use App\Mail\api\auth\ResetPassMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\apiResourceTrait;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use App\Mail\Api\Auth\SendCodeMail;

class PasswordResetController extends Controller
{

    use apiResourceTrait;

    public function sendResetMail(Request $request)
    {
        $rules = [
            'email' => 'required|string|email|exists:users,email',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
            return $this->returnValidationError($validator);

        $codeUpdate = User::where('email', $request->email)->update(['code' => rand(100000, 999999)]);

        if (!$codeUpdate)
            return $this->returnError('Something went wrong, please try again');

        $user = User::where('email', $request->email)->first();

        Mail::to($user->email)->send(new ResetPassMail($user));

        return $this->returnSuccessMessage('The reset code has been sent successfully');
    }

    public function resetPass(Request $request)
    {
        $rules = [
            'code' => ['required', 'integer', 'digits:6', 'exists:users,code'],
            'email' => 'required|string|email|exists:users,email',
            'password' => ['required', 'confirmed', Rules\Password::defaults(), 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
            return $this->returnValidationError($validator);

        $verifyOnCode = User::select('code')->where('email',$request->email)->first();

        if($verifyOnCode->code != $request->code)
            return $this->returnError('Wrong code');

        $resetPass = User::where('email', $request->email)->update([
            'password' => bcrypt($request->password),
            'email_verified_at'=> null,
            'code'=> rand(100000,999999),
        ]);

        if(!$resetPass)
            return $this->returnError('Something went wrong, please try again');

            $user = User::where('email',$request->email)->first();

            Mail::to($user->email)->send(new SendCodeMail($user));

        return $this->returnSuccessMessage('You have changed your password successfully, please check your email inbox for the verification code to verify your account again');
    }
}

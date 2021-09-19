<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Traits\apiResourceTrait;
use Illuminate\Support\Facades\Mail;
use App\Mail\Api\Auth\SendCodeMail;

class VerificationController extends Controller
{
    use apiResourceTrait;

    public function verify(Request $request)
    {
        $user = User::select('code')->where('id', auth('api')->user()->id)->first();

        $rules = [
            'code' => ['required', 'integer', 'digits:6', 'exists:users,code', Rule::in([$user->code])],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
            return $this->returnValidationError($validator);

        date_default_timezone_set('Africa/Cairo');

        $verifyUser = User::find(auth('api')->user()->id);
        $verifyUser->email_verified_at = date('Y-m-d H:i:s');
        $verifyUser->save();

        if (!$verifyUser)
            return $this->returnError('Something went wrong, please try again', 500);

        $token = $request->header('Authorization');

        return $this->returnDataWithToken('api', $verifyUser, $token, 'user');
    }

    public function sendCode(Request $request)
    {
        $user = User::find(auth('api')->user()->id);
        $user->code = rand(100000, 999999);
        $user->save();

        Mail::to($user->email)->send(new SendCodeMail($user));

        $token = $request->header('Authorization');

        return $this->returnDataWithToken('api', $user, $token, 'user');
    }
}

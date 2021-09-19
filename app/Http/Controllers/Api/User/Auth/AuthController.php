<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\apiResourceTrait;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    use apiResourceTrait;

    public function store(Request $request)
    {
        $rules = [
            'email' => 'required|string|email|exists:users,email',
            'password' => 'required|string|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
            return $this->returnValidationError($validator);

        $token = auth('api')->attempt($request->all());

        if (!$token)
            return $this->returnError('Unauthorized user', 401);

        $user = auth('api')->user();

        if (!$user->email_verified_at)
            return $this->returnDataWithToken('api', $user, 'bearer ' . $token, 'user', 401);

        return $this->returnDataWithToken('api', $user, 'bearer ' . $token, 'user');
    }

    public function destroy(Request $request)
    {
        auth('api')->logout();

        return $this->returnSuccessMessage('You have logged out successfully');
    }
}

<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Events\Api\Auth\NewRegistered;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\apiResourceTrait;

class RegisteredUserController extends Controller
{

    use apiResourceTrait;

    public function store(Request $request)
    {
        $rules = [
            'fname' => 'required|string|max:25',
            'lname' => 'required|string|max:25',
            'email' => 'required|string|email|max:50|unique:users',
            'phone' => 'required|numeric|digits_between:11,15|unique:users',
            'gender' => ['required', Rule::in(['m', 'f']),],
            'birthdate' => ['required', 'date', 'after_or_equal:' . date_sub(now(), date_interval_create_from_date_string("120 years"))->format('Y-m-d'), 'before_or_equal:' . date_sub(now(), date_interval_create_from_date_string("15 years"))->format('Y-m-d')],
            'password' => ['required', 'confirmed', Rules\Password::defaults(), 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
            return $this->returnValidationError($validator);

        $request['name'] = $request->only('fname', 'lname');

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'phone' => $request['phone'],
            'gender' => $request['gender'],
            'birthdate' => $request['birthdate'],
            'code' => rand('100000', '999999'),
        ]);

        if (!$user)
            $this->returnError('Something went wrong', 500);

        $credentials = $request->only('email', 'password');
        $token = auth('api')->attempt($credentials);
        $user = auth('api')->user();

        event(new NewRegistered($user));

        return $this->returnDataWithToken('api', $user, 'bearer ' . $token, 'user');
    }
}

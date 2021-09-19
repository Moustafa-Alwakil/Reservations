<?php

namespace App\Http\Controllers\Api\User\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\apiResourceTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{

    use apiResourceTrait;

    public function index(Request $request)
    {
        $user = User::where('id', auth('api')->user()->id)->first();

        if (!$user)
            return $this->returnError('Something went wrong, please try again', 500);

        $token = $request->header('Authorization');

        return $this->returnDataWithToken('api', $user, $token, 'user');
    }

    public function update(Request $request)
    {
        $rules = [
            'fname' => 'required|string|max:25',
            'lname' => 'required|string|max:25',
            'email' => ['required', 'string', 'email', 'max:50', Rule::unique('users')->ignore(Auth::guard('api')->user()->id)],
            'phone' => ['required', 'numeric', 'digits_between:11,15', Rule::unique('users')->ignore(Auth::guard('api')->user()->id)],
            'gender' => ['required', Rule::in(['m', 'f']),],
            'birthdate' => ['required', 'date', 'after_or_equal:' . date_sub(now(), date_interval_create_from_date_string("120 years"))->format('Y-m-d'), 'before_or_equal:' . date_sub(now(), date_interval_create_from_date_string("15 years"))->format('Y-m-d')],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
            return $this->returnValidationError($validator);

        $updateUser = User::find(auth('api')->user()->id);
        $updateUser->name = $request->only('fname', 'lname');
        $updateUser->email = $request->email;
        $updateUser->phone = $request->phone;
        $updateUser->gender = $request->gender;
        $updateUser->birthdate = $request->birthdate;
        $updateUser->save();

        if (!$updateUser)
            return $this->returnError('Something went wrong, please try again', 500);

        $token = $request->header('Authoriztion');

        return $this->returnDataWithToken('api', $updateUser, $token, 'user');
    }
}

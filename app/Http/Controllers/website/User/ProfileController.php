<?php

namespace App\Http\Controllers\Website\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\website\user\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::select('name', 'email', 'birthdate', 'gender', 'phone', 'email_verified_at')->where('id',Auth::guard('web')->user()->id)->get();
        $user = $user[0];
        return view('website.user.profile', compact('user'));
    }
    public function Update(UpdateProfileRequest $request)
    {
        $request->validated();
        Validator::make($request->toArray(), [
            'email' => [
                Rule::unique('users')->ignore($request->id),
            ],
            'phone' => [
                Rule::unique('users')->ignore($request->id)
            ],
        ]);
        $request['name'] = json_encode($request->only('fname', 'lname'));
        $data = $request->except('_token', 'fname', 'lname');
        $store = User::where('id',Auth::guard('web')->user()->id)->update($data);
        if (!$store) {
            return redirect()->route('user.profile', [$request->id])->with('error', 'Something went wrong');
        }
        return redirect()->route('user.profile', [$request->id])->with('success','Successfuly Updated');
    }
}

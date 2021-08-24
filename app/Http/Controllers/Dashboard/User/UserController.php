<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\User\ResetPassUserRequest;
use App\Http\Requests\Dashboard\User\StoreUserRequest;
use App\Http\Requests\Dashboard\User\UpdateUserRequest;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::select()->get();
        return view('dashboard.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $request['name'] = $request->only('fname', 'lname');
        $data = $request->except('_token', 'fname', 'lname', 'password_confirmation');

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phone' => $data['phone'],
            'gender' => $data['gender'],
            'birthdate' => $data['birthdate'],
        ]);

        if (!$user)
            return redirect()->route('users.create')->with('error', __('website\includes\sessionDisplay.wrong'));

        return redirect()->route('users.index')->with('success', 'The data has been saved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        return view('dashboard.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $request['name'] = $request->only('fname', 'lname');
        $data = $request->except('_token', 'fname', 'lname', '_method');
        $user = User::where('id', $id)->first();

        if (!($data['email'] == $user->email)) {

            $data['email_verified_at'] = null;
            $store = User::where('id', $id)->update($data);

            if (!$store)
                return redirect()->back()->with('error', __('website\includes\sessionDisplay.wrong'));

            return redirect()->route('users.index')->with('success', 'The data has been saved successfully.');
        } else {
            $store = User::where('id', $id)->update($data);

            if (!$store)
                return redirect()->back()->with('error', __('website\includes\sessionDisplay.wrong'));

            return redirect()->route('users.index')->with('success', 'The data has been saved successfully.');
        }
    }

    public function showResetPass($id)
    {
        $user = User::where('id', $id)->first();
        return view('dashboard.user.reset', compact('user'));
    }

    public function resetPass(ResetPassUserRequest $request)
    {
        $user = User::find($request->id);
        return 1;
        $user->password = bcrypt($request->password);
        $user->save();
        if (!$user)
            return redirect()->back()->with('error', __('website\includes\sessionDisplay.wrong'));

        return redirect()->route('users.index')->with('success', 'Password has been reset successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user)
            return redirect()->route('users.index')->with('error', __('website\includes\sessionDisplay.wrong'));

        $user->delete();
        return redirect()->route('users.index')->with('success', 'Successfully deleted!');
    }
}

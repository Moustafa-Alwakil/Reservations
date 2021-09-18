<?php

namespace App\Http\Controllers\Dashboard\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Doctor\StoreDoctorRequest;
use App\Http\Requests\Dashboard\Doctor\UpdateDoctorRequest;
use App\Models\Physican;

class DoctorController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:read')->only('index');
        $this->middleware('permission:create')->only('create','store');
        $this->middleware('permission:update')->only('edit','update');
        $this->middleware('permission:delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Physican::select()->get();
        return view('dashboard.doctor.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.doctor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDoctorRequest $request)
    {
        $request['name'] = $request->only('fname_ar', 'lname_ar', 'fname_en', 'lname_en');
        $data = $request->except('_token', 'fname_ar', 'lname_ar', 'fname_en', 'lname_en', 'password_confirmation');

        $doctor = Physican::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'gender' => $data['gender'],
            'birthdate' => $data['birthdate'],
        ]);

        if (!$doctor)
            return redirect()->route('doctors.create')->with('error', __('website\includes\sessionDisplay.wrong'));

        return redirect()->route('doctors.index')->with('success', 'The data has been saved successfully.');
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
        $doctor = Physican::where('id', $id)->first();
        return view('dashboard.doctor.edit', compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDoctorRequest $request, $id)
    {
        $request['name'] = $request->only('fname_ar', 'lname_ar', 'fname_en', 'lname_en');
        $data = $request->except('_token', 'fname', 'fname_ar', 'lname_ar', 'fname_en', 'lname_en', '_method');
        $doctor = Physican::where('id', $id)->first();

        if (!($data['email'] == $doctor->email)) {

            $data['email_verified_at'] = null;
            $store = Physican::where('id', $id)->update($data);

            if (!$store)
                return redirect()->back()->with('error', __('website\includes\sessionDisplay.wrong'));

            return redirect()->route('doctors.index')->with('success', 'The data has been saved successfully.');
        } else {
            $store = Physican::where('id', $id)->update($data);

            if (!$store)
                return redirect()->back()->with('error', __('website\includes\sessionDisplay.wrong'));

            return redirect()->route('doctors.index')->with('success', 'The data has been saved successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctor = Physican::find($id);

        if (!$doctor)
            return redirect()->route('doctors.index')->with('error', __('website\includes\sessionDisplay.wrong'));

        $doctor->delete();
        return redirect()->route('doctors.index')->with('success', 'Successfully deleted!');
    }
}

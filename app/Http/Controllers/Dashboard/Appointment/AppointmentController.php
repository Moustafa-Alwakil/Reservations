<?php

namespace App\Http\Controllers\Dashboard\Appointment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Appointment\StoreAppointmentRequest;
use App\Http\Requests\Dashboard\Appointment\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Models\Clinic;
use App\Models\User;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = Appointment::select()->with(['clinic' => function ($q) {
            $q->select('id', 'name');
        }, 'user' => function ($q) {
            $q->select('id', 'name');
        }])->get();

        return view('dashboard.appointment.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clinics = Clinic::select('id','name')->get();
        $users = User::select('id','name')->get();
        return view('dashboard.appointment.create',compact('clinics','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAppointmentRequest $request)
    {
        $data = $request->except('_token');
        $data['bookdate'] = date_format(date_create($request->bookdate),'j M Y');

        $storeAppointment = Appointment::create($data);

        if (!$storeAppointment)
            return redirect()->route('appointments.create')->with('error', __('website\includes\sessionDisplay.wrong'));

        return redirect()->route('appointments.index')->with('success', 'Successfully added');
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
        $appointment = Appointment::select()->where('id',$id)->with(['clinic'=>function($q){
            $q->select('id','name');
        },'user'=>function($q){
            $q->select('id','name');
        }])->first();
        $users = User::select('id','name')->get();
        $clinics = Clinic::select('id','name')->get();
        
        return view('dashboard.appointment.edit',compact('appointment','users','clinics'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAppointmentRequest $request, $id)
    {
        $data = $request->except('_token','_method');
        $data['bookdate'] = date_format(date_create($request->bookdate),'j M Y');
        $updateAppointment = Appointment::where('id',$id)->update($data);

        if (!$updateAppointment)
        return redirect()->route('appointments.edit',['appointment'=>$id])->with('error', __('website\includes\sessionDisplay.wrong'));

    return redirect()->route('appointments.index')->with('success', 'Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment)
            return redirect()->route('appointments.index')->with('error', __('website\includes\sessionDisplay.wrong'));

        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Successfully deleted!');
    }
}

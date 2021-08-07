<?php

namespace App\Http\Controllers\Website\User\Appointment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\User\Appointment\StoreAppointmentRequest;
use App\Http\Requests\Website\User\Appointment\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Models\Clinic;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('user_id', Auth::guard('web')->user()->id)->with(['clinic' => function ($q) {
            $q->select('id', 'name', 'physican_id')->with(['physican' => function ($q) {
                $q->select('id', 'name', 'department_id')->with(['info' => function ($q) {
                    $q->select('id', 'photo', 'physican_id');
                }, 'department']);
            }, 'examfee']);
        }])->get();
        return view('website.user.appointment.index', compact('appointments'));
    }


    public function create($id)
    {
        $clinic = Clinic::select('id', 'name', 'physican_id')->where(['status' => 1, 'review' => 1, 'id' => $id])->with(['address' => function ($q) {
            $q->select('id', 'region_id', 'clinic_id')->with(['region' => function ($q) {
                $q->select()->where('status', 1);
            }, 'region.city' => function ($q) {
                $q->select()->where('status', 1);
            }]);
        }, 'physican' => function ($q) {
            $q->select('id', 'name')->where('status', 1)->withCount('reviews')->with(['info' => function ($q) {
                $q->select('id', 'photo', 'physican_id');
            }, 'reviews' => function ($q) {
                $q->select();
            }]);
        }, 'workday', 'appointments'=>function($q){
            $q->select()->where('date','>=',date('Y-m-d'));
        }, 'exceptions'])->first();
        return view('website.user.appointment.create', compact('clinic'));
    }

    public function store(StoreAppointmentRequest $request)
    {
        $data = $request->except('_token');
        $data['user_id'] = Auth::guard('web')->user()->id;

        $storeAppointment = Appointment::create($data);

        if (!$storeAppointment)
            return redirect()->back()->with('error', 'Something went wrong, please try again.');

        return redirect()->route('appointment.index')->with('success', 'You have successfully booked an appointment.');
    }

    public function update(UpdateAppointmentRequest $request)
    {
        $updateAppointment = Appointment::where(['id'=>$request->id , 'user_id' => Auth::guard('web')->user()->id])->update(['status'=>3]);

        if(!$updateAppointment)
            return redirect()->route('appointment.index')->with('error','Something went wrong, please try again.');

            return redirect()->route('appointment.index')->with('success','You have been canceled your booking successfully.');
    }
}

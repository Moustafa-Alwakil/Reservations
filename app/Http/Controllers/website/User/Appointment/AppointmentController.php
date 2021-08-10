<?php

namespace App\Http\Controllers\Website\User\Appointment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\User\Appointment\StoreAppointmentRequest;
use App\Http\Requests\Website\User\Appointment\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Models\Clinic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::select(DB::raw("CONCAT(appointments.date,' ',appointments.start_time)  AS datetime"), 'id', 'clinic_id', 'user_id', 'date', 'bookdate', 'start_time', 'end_time', 'status')->where('user_id', Auth::guard('web')->user()->id)->with(['clinic' => function ($q) {
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
        $clinic = Clinic::select('id', 'name', 'phone','physican_id')->where(['status' => 1, 'review' => 1, 'id' => $id])->with(['address' => function ($q) {
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
            return redirect()->back()->with('error', __('website\includes\sessionDisplay.wrong'));

        return redirect()->route('appointment.index')->with('success', __('website\includes\sessionDisplay.successbook'));
    }

    public function update(UpdateAppointmentRequest $request)
    {
        $updateAppointment = Appointment::where(['id'=>$request->id , 'user_id' => Auth::guard('web')->user()->id])->update(['status'=>3]);

        if(!$updateAppointment)
            return redirect()->route('appointment.index')->with('error',__('website\includes\sessionDisplay.wrong'));

            return redirect()->route('appointment.index')->with('success',__('website\includes\sessionDisplay.successcancle'));
    }
}

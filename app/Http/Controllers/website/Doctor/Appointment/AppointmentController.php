<?php

namespace App\Http\Controllers\Website\Doctor\Appointment;

use App\Events\Website\Doctor\Appointment\AppointmentConfirmed;
use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Doctor\Appointment\UpdateAppointmentRequest;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function update(UpdateAppointmentRequest $request)
    {
        $appointment = Appointment::select()->where('id',$request->id)->with(['user', 'clinic' => function ($q) {
            $q->select()->with(['physican', 'address' => function ($q) {
                $q->select()->with(['region' => function ($q) {
                    $q->select()->with('city');
                }]);
            },'examfee']);
        }])->first();

        if (!$appointment)
            return response()->json([
                'status' => false,
            ]);

        if ($request->status == 1) {
            $updateAppointment = $appointment->update(['status' => $request->status]);

            if (!$updateAppointment) {
                return response()->json([
                    'status' => false,
                ]);
            }
            event(new AppointmentConfirmed($appointment));

            return response()->json([
                'status' => true,
                'id' => $request->id,
            ]);
        }

        if ($request->status == 2) {
            $updateAppointment = $appointment->update(['status' => $request->status]);

            if (!$updateAppointment) {
                return response()->json([
                    'status' => false,
                ]);
            }

            return response()->json([
                'status' => true,
                'id' => $request->id,
            ]);
        }
    }
}

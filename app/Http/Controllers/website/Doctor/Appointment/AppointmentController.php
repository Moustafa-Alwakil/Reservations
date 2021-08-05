<?php

namespace App\Http\Controllers\Website\Doctor\Appointment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Doctor\Appointment\UpdateAppointmentRequest;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function update(UpdateAppointmentRequest $request)
    {
        $appointment = Appointment::find($request->id);

        if (!$appointment)
            return response()->json([
                'status' => false,
            ]);

        if ($request->status == 1)
            $appointment->update(['status' => $request->status]);

        if ($request->status == 2)
            $appointment->update(['status' => $request->status]);

        return response()->json([
            'status' => true,
            'id' => $request->id,
        ]);
    }
    // public  function update(Request $request){
    //     $offer = Offer::find($request -> offer_id);
    //     if (!$offer)
    //         return response()->json([
    //             'status' => false,
    //             'msg' => 'هذ العرض غير موجود',
    //         ]);

    //     //update data
    //     $offer->update($request->all());

    //     return response()->json([
    //         'status' => true,
    //         'msg' => 'تم  التحديث بنجاح',
    //     ]);
    // }

}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Events\Dashboard\ClinicAccepted;
use App\Events\Dashboard\DoctorAccepted;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UpdateClinicStatusRequest;
use App\Http\Requests\Dashboard\UpdateDoctorStatusRequest;
use App\Models\Appointment;
use App\Models\Clinic;
use App\Models\Physican;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        $doctorsCount = Physican::count();
        $clinicsCount = Clinic::count();
        $usersCount = User::count();
        $apptsCount = Appointment::where('status', 1)->count();

        $waitingDoctors = Physican::select('id', 'name', 'department_id')
        ->where('status', 2)
        ->whereNotNull('department_id')
        ->with(['info' => function ($q) {
            $q->select('id', 'physican_id', 'photo', 'license');
        }, 'department'])->get();

        $waitingClinics = Clinic::select('id', 'name', 'license', 'physican_id')->where('review',2)->with(['physican' => function ($q) {
            $q->select('id', 'name','department_id')->with('department');
        }])->get();
        
        return view('dashboard.index', compact('doctorsCount', 'clinicsCount', 'usersCount', 'apptsCount', 'waitingDoctors', 'waitingClinics'));
    }

    public function updateDoctorStatus(UpdateDoctorStatusRequest $request)
    {
        $doctor = Physican::select()->where(['id' => $request->id, 'status' => 2])->first();

        if (!$doctor)
            return response()->json([
                'status' => false,
            ]);

        if ($request->status == 1) {
            $updateDoctorStatus = $doctor->update(['status' => $request->status]);

            if (!$updateDoctorStatus) {
                return response()->json([
                    'status' => false,
                ]);
            }

            event(new DoctorAccepted($doctor));

            return response()->json([
                'status' => true,
                'id' => $request->id,
            ]);
        }

        if ($request->status == 0) {
            $updateDoctorStatus = $doctor->update(['status' => $request->status]);

            if (!$updateDoctorStatus) {
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
    public function updateClinicStatus(UpdateClinicStatusRequest $request)
    {
        $clinic = Clinic::select()->where(['id' => $request->id, 'review' => 2])->with(['physican'=>function($q){
            $q->select('id','name','email');
        }])->first();

        if (!$clinic)
            return response()->json([
                'status' => false,
            ]);

        if ($request->review == 1) {
            $updateClinicStatus = $clinic->update(['review' => $request->review]);

            if (!$updateClinicStatus) {
                return response()->json([
                    'status' => false,
                ]);
            }

            event(new ClinicAccepted($clinic));

            return response()->json([
                'status' => true,
                'id' => $request->id,
            ]);
        }

        if ($request->review == 0) {
            $updateClinicStatus = $clinic->update(['review' => $request->review]);

            if (!$updateClinicStatus) {
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

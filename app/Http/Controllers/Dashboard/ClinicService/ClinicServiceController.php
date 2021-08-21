<?php

namespace App\Http\Controllers\Dashboard\ClinicService;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ClinicService\StoreClinicServiceRequest;
use App\Http\Requests\Dashboard\ClinicService\UpdateClinicServiceRequest;
use App\Models\Clinic;
use App\Models\ClinicService;
use App\Models\Physican;
use App\Models\Service;
use Illuminate\Http\Request;

class ClinicServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clinicServices = ClinicService::select()->with(['clinic' => function ($q) {
            $q->select('id', 'name', 'physican_id')->with(['physican' => function ($q) {
                $q->select('id', 'name', 'department_id')->with(['department' => function ($q) {
                    $q->select('id', 'name');
                }]);
            }]);
        }])->get();
        return view('dashboard.clinicService.index', compact('clinicServices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors['data'] = Physican::select('id', 'name', 'department_id')->get();
        return view('dashboard.clinicService.create', compact('doctors'));
    }

    public function getClinics($clinicservice, $id)
    {
        $clinics['data'] = Clinic::select('id', 'name', 'physican_id')->where('physican_id', $id)->get();
        return response()->json($clinics);
    }

    public function getClinic($id)
    {
        $clinics['data'] = Clinic::select('id', 'name', 'physican_id')->where('physican_id', $id)->get();
        return response()->json($clinics);
    }

    public function getServices($clinicservice, $id)
    {
        $doctor = Physican::where('id', $id)->first();
        $services['data'] = Service::select('id', 'name', 'department_id')->where('department_id', $doctor->department_id)->get();
        return response()->json($services);
    }

    public function getService($id)
    {
        $doctor = Physican::where('id', $id)->first();
        $services['data'] = Service::select('id', 'name', 'department_id')->where('department_id', $doctor->department_id)->get();
        return response()->json($services);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClinicServiceRequest $request)
    {
        $clinicServices = ClinicService::select()->where('clinic_id', $request->clinic_id)->get();
        $i = 0;
        $existServices = [];
        foreach ($clinicServices as $service) {
            $existServices[$i] = $service->service_id;
            $i++;
        }
        if (in_array($request->service_id, $existServices))
            return redirect()->route('clinicservices.create')->with('error', 'This service is already exists for this clinic.');

        $service = ClinicService::create($request->except('_token'));

        if (!$service)
            return redirect()->route('clinicservices.create')->with('error', 'Something went wrong, please try again.');

        return redirect()->route('clinicservices.index')->with('success', 'The data has been saved successfully.');
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
        $clinicService = ClinicService::where('id', $id)->with(['clinic' => function ($q) {
            $q->select('id', 'name', 'physican_id')->with(['physican' => function ($q) {
                $q->select('id', 'name', 'department_id');
            }]);
        }])->first();
        $services = Service::select()->where('department_id',$clinicService->clinic->physican->department_id)->get();
        return view('dashboard.clinicService.edit', compact('clinicService', 'services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClinicServiceRequest $request, $id)
    {
        $service = ClinicService::where('id',$id)->update(['service_id'=>$request->service_id]);

        if (!$service)
            return redirect()->back()->with('error', 'Something went wrong, please try again.');

        return redirect()->route('clinicservices.index')->with('success', 'The data has been saved successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clinicService = ClinicService::find($id);

        if (!$clinicService)
            return redirect()->route('clinicservices.index')->with('error', __('website\includes\sessionDisplay.wrong'));

        $clinicService->delete();
        return redirect()->route('clinicservices.index')->with('success', 'Successfully deleted!');
    }
}

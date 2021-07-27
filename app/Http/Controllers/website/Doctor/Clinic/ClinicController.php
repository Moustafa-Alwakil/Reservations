<?php

namespace App\Http\Controllers\Website\Doctor\Clinic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Doctor\Clinic\StoreClinicRequest;
use App\Models\Address;
use App\Models\City;
use App\Models\Clinic;
use App\Models\Clinicphoto;
use App\Models\ClinicService;
use App\Models\Examfee;
use App\Models\Region;
use App\Models\Service;
use App\Models\Workday;
use App\Traits\uploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClinicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use uploadTrait;

    public function index()
    {
        return view('website.doctor.clinic.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities['data'] = City::select()->where('status', 1)->get();
        $services = Service::select()->where('status', 1)->where('department_id', Auth::guard('doc')->user()->department_id)->get();
        return view('website.doctor.clinic.create', compact('services', 'cities'));
    }

    public function getRegions($id)
    {

        $regions['data'] = Region::select('name', 'id')->where('city_id', $id)->get();

        return response()->json($regions);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClinicRequest $request)
    {
        $request->validated();

        $clinic['name'] = $request->only('name_ar', 'name_en');
        $clinic['phone'] = $request->phone;
        $clinic['status'] = $request->status;

        $license = $this->uploadPhoto(Auth::guard('doc')->user()->id, $request->license, 'clinics-licenses');
        if (!$license)
            return redirect()->route('clinics.create')->with('error', 'Something went wrong, please try again.');

        $clinic['license'] = $license;
        $clinic['physican_id'] = Auth::guard('doc')->user()->id;
        $storeClinic = Clinic::create($clinic);

        if (!$storeClinic)
            return redirect()->route('clinics.create')->with('error', 'Something went wrong, please try again.');

        foreach ($request->photo as $photo) {
            $clinicphoto = $this->uploadPhoto(Auth::guard('doc')->user()->id, $photo, 'clinics-photos');

            if (!$clinicphoto)
                return redirect()->route('clinics.create')->with('error', 'Something went wrong, please try again.');

            $storeClinicPhoto = Clinicphoto::create(['photo' => $clinicphoto, 'clinic_id' => $storeClinic->id]);

            if (!$storeClinicPhoto)
                return redirect()->route('clinics.create')->with('error', 'Something went wrong, please try again.');
        }

        $address['street'] = $request->only('street_ar', 'street_en');
        $address['buildingno'] = $request->buildingno;
        $address['floor'] = $request->floor;
        $address['apartno'] = $request->apartno;
        $address['landmark'] = $request->only('landmark_ar', 'landmark_en');
        $storeAddress = Address::create($address);

        if (!$storeAddress)
            return redirect()->route('clinics.create')->with('error', 'Something went wrong, please try again.');

        Clinic::where('id', $storeClinic->id)->update(['examfee_id' => $storeAddress->id]);

        $workday['available']['saturday'] = $request->only('sat_status', 'sat_start_time', 'sat_end_time', 'sat_duration');
        $workday['available']['sunday'] = $request->only('sun_status', 'sun_start_time', 'sun_end_time', 'sun_duration');
        $workday['available']['monday'] = $request->only('mon_status', 'mon_start_time', 'mon_end_time', 'mon_duration');
        $workday['available']['tuesday'] = $request->only('tue_status', 'tue_start_time', 'tue_end_time', 'tue_duration');
        $workday['available']['wednesday'] = $request->only('wed_status', 'wed_start_time', 'wed_end_time', 'wed_duration');
        $workday['available']['thursday'] = $request->only('thu_status', 'thu_start_time', 'thu_end_time', 'thu_duration');
        $workday['available']['friday'] = $request->only('fri_status', 'fri_start_time', 'fri_end_time', 'fri_duration');
        $storeWorkdays = Workday::create(['available' => $workday['available'], 'clinic_id' => $storeClinic->id]);

        if (!$storeWorkdays)
            return redirect()->route('clinics.create')->with('error', 'Something went wrong, please try again.');

        foreach ($request->service_id as $service_id) {
            $storeClinicServices = ClinicService::create(['service_id' => $service_id, 'clinic_id' => $storeClinic->id]);

            if (!$storeClinicServices)
                return redirect()->route('clinics.create')->with('error', 'Something went wrong, please try again.');
        }

        $storePrice = Examfee::create(['price' => $request->price]);

        if (!$storePrice)
            return redirect()->route('clinics.create')->with('error', 'Something went wrong, please try again.');

        Clinic::where('id', $storeClinic->id)->update(['examfee_id' => $storePrice->id]);

        return redirect()->route('clinics.create')->with('success', 'success.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

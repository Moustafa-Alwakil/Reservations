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
        $clinics = Clinic::select('id', 'name', 'status', 'review')->with(['address', 'address.region' => function ($q) {
            $q->select('id', 'name', 'city_id');
        }, 'address.region.city' => function ($q) {
            $q->select('id', 'name');
        }, 'examfee'])->where('physican_id', Auth::guard('doc')->user()->id)->get();
        return view('website.doctor.clinic.index', compact('clinics'));
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
        $clinic['name'] = $request->only('name_ar', 'name_en');
        $clinic['phone'] = $request->phone;
        $clinic['status'] = $request->status;

        $license = $this->uploadPhoto(1,Auth::guard('doc')->user()->id, $request->license, 'clinics-licenses');
        if (!$license)
            return redirect()->route('clinics.create')->with('error', 'Something went wrong, please try again.');

        $clinic['license'] = $license;
        $clinic['physican_id'] = Auth::guard('doc')->user()->id;
        $storeClinic = Clinic::create($clinic);

        if (!$storeClinic)
            return redirect()->route('clinics.create')->with('error', 'Something went wrong, please try again.');
        $i = 1;
        foreach ($request->photo as $photo) {
            $clinicphoto = $this->uploadPhoto($i,Auth::guard('doc')->user()->id, $photo, 'clinics-photos');

            if (!$clinicphoto)
                return redirect()->route('clinics.create')->with('error', 'Something went wrong, please try again.');

            $storeClinicPhoto = Clinicphoto::create(['photo' => $clinicphoto, 'clinic_id' => $storeClinic->id]);

            if (!$storeClinicPhoto)
                return redirect()->route('clinics.create')->with('error', 'Something went wrong, please try again.');
            $i++;
        }

        $address['street'] = $request->only('street_ar', 'street_en');
        $address['building'] = $request->only('building_ar', 'building_en');
        $address['floor'] = $request->floor;
        $address['apartno'] = $request->apartno;
        $address['landmark'] = $request->only('landmark_ar', 'landmark_en');
        $address['region_id'] = $request->region_id;
        $address['clinic_id'] = $storeClinic->id;
        $storeAddress = Address::create($address);


        if (!$storeAddress)
            return redirect()->route('clinics.create')->with('error', 'Something went wrong, please try again.');

        $workday['available']['saturday'] = $request->only('sat_status', 'sat_start_time', 'sat_end_time', 'sat_duration');
        $workday['available']['sunday'] = $request->only('sun_status', 'sun_start_time', 'sun_end_time', 'sun_duration');
        $workday['available']['monday'] = $request->only('mon_status', 'mon_start_time', 'mon_end_time', 'mon_duration');
        $workday['available']['tuesday'] = $request->only('tue_status', 'tue_start_time', 'tue_end_time', 'tue_duration');
        $workday['available']['wednesday'] = $request->only('wed_status', 'wed_start_time', 'wed_end_time', 'wed_duration');
        $workday['available']['thursday'] = $request->only('thu_status', 'thu_start_time', 'thu_end_time', 'thu_duration');
        $workday['available']['friday'] = $request->only('fri_status', 'fri_start_time', 'fri_end_time', 'fri_duration');
        $workday['clinic_id'] = $storeClinic->id;
        $storeWorkdays = Workday::create($workday);

        if (!$storeWorkdays)
            return redirect()->route('clinics.create')->with('error', 'Something went wrong, please try again.');

        foreach ($request->service_id as $service_id) {
            $storeClinicServices = ClinicService::create(['service_id' => $service_id, 'clinic_id' => $storeClinic->id]);

            if (!$storeClinicServices)
                return redirect()->route('clinics.create')->with('error', 'Something went wrong, please try again.');
        }

        $examfee['price'] = $request->price;
        $examfee['clinic_id'] = $storeClinic->id;
        $storePrice = Examfee::create($examfee);

        if (!$storePrice)
            return redirect()->route('clinics.create')->with('error', 'Something went wrong, please try again.');


        return redirect()->route('clinics.index')->with('success', 'The clinic has been created successfully.');
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
        $clinic = Clinic::select()->with(['address', 'address.region', 'examfee', 'workday','services'=>function($q){$q->select('service_id');}])->where('id', $id)->where('physican_id', Auth::guard('doc')->user()->id)->first();
        $cities['data'] = City::select()->where('status', 1)->get();
        $services = Service::select()->where('status', 1)->where('department_id', Auth::guard('doc')->user()->department_id)->get();
        return view('website.doctor.clinic.edit', compact('clinic','services','cities'));
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
        $clinic = Clinic::select()->with('clinicphotos')->where('id', $id)->where('physican_id', Auth::guard('doc')->user()->id)->first();

        if (!$clinic)
            return redirect()->route('clinics.index')->with('error', 'Something went wrong, please try again.');

        $file = (explode("clinics-licenses/", $clinic->license));
        $path = public_path('images\clinics-licenses\\' . $file[0]);
        $deleteLicense = $this->deletePhoto($path);

        // if (!$deleteLicense)
        //     return redirect()->route('clinics.index')->with('error', 'Something went wrong, please try again.');

        foreach ($clinic->clinicphotos as $clinicphoto) {
            $file = (explode("clinics-photos/", $clinicphoto->photo));
            $path = public_path('images\clinics-photos\\' . $file[1]);
            $deleteClinicPhoto = $this->deletePhoto($path);

            if (!$deleteClinicPhoto)
            return redirect()->route('clinics.index')->with('error', 'Something went wrong, please try again.');
        }

        $delete = $clinic->delete();

        if (!$delete)
        return redirect()->route('clinics.index')->with('error', 'Something went wrong, please try again.');

        return redirect()->route('clinics.index')->with('success', 'The clinic has been deleted successfully.');
    }
}

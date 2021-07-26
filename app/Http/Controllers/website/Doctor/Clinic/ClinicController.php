<?php

namespace App\Http\Controllers\Website\Doctor\Clinic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Doctor\Clinic\StoreClinicRequest;
use App\Models\City;
use App\Models\Clinic;
use App\Models\Region;
use App\Models\Service;
use App\Traits\uploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LaravelLocalization;

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
        $cities['data'] = City::select()->where('status', 1)->orderby('name')->get();
        $services = Service::select()->where('status', 1)->where('department_id', Auth::guard('doc')->user()->department_id)->get();
        return view('website.doctor.clinic.create', compact('services', 'cities'));
    }

    public function getRegions($cityid = 0)
    {

        $regions['data'] = Region::select('name','id')->where('city_id', $cityid)->get();

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

        $license = $this->uploadPhoto(Auth::guard('doc')->user()->id, $request->license, 'clinics-licenses');
        if (!$license)
            return redirect()->route('clinics.create')->with('error', 'Something went wrong, please try again.');

        $request['name'] = $request->only('name_ar', 'name_en');
        $data = $request->except('_token', 'name_ar', 'name_en', 'license');
        $data['license'] = $license;
        $data['physican_id'] = Auth::guard('doc')->user()->id;

        $store = Clinic::create($data);
        if (!$store)
            return redirect()->route('clinic.create')->with('error', 'Something went wrong, please try again.');

        return redirect()->route('clinic.create')->with('success', 'Clinic created successfully.');
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

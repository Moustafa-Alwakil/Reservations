<?php

namespace App\Http\Controllers\Dashboard\Address;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Address\StoreAddressRequest;
use App\Http\Requests\Dashboard\Address\UpdateAddressRequest;
use App\Models\Address;
use App\Models\City;
use App\Models\Clinic;
use App\Models\Physican;
use App\Models\Region;

class AddressController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:read')->only('index');
        $this->middleware('permission:create')->only('create','store');
        $this->middleware('permission:update')->only('edit','update');
        $this->middleware('permission:delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = Address::select()->with(['clinic' => function ($q) {
            $q->select('id', 'name');
        }, 'region', 'region.city'])->get();
        return view('dashboard.address.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors['data'] = Physican::select('id', 'name')->get();
        $cities['data'] = City::select()->get();
        return view('dashboard.address.create', compact('doctors', 'cities'));
    }

    public function getRegions($address, $id)
    {
        $regions['data'] = Region::select('name', 'id')->where('city_id', $id)->get();
        return response()->json($regions);
    }

    public function getRegion($id)
    {
        $regions['data'] = Region::select('name', 'id')->where('city_id', $id)->get();
        return response()->json($regions);
    }

    public function getClinics($address, $id)
    {
        $clinics['data'] = Clinic::select('id', 'name', 'physican_id')->where('physican_id', $id)->get();
        return response()->json($clinics);
    }

    public function getClinic($id)
    {
        $clinics['data'] = Clinic::select('id', 'name', 'physican_id')->where('physican_id', $id)->get();
        return response()->json($clinics);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAddressRequest $request)
    {
        $address['street'] = $request->only('street_ar', 'street_en');
        $address['building'] = $request->only('building_ar', 'building_en');
        $address['floor'] = $request->floor;
        $address['apartno'] = $request->apartno;
        $address['landmark'] = $request->only('landmark_ar', 'landmark_en');
        $address['region_id'] = $request->region_id;
        $address['clinic_id'] = $request->clinic_id;

        $storeAddress = Address::create($address);

        if (!$storeAddress)
            return redirect()->route('addresses.create')->with('error', __('website\includes\sessionDisplay.wrong'));

        return redirect()->route('addresses.index')->with('success', 'Successfully added');
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
        $address = Address::select()->where('id', $id)->with(['clinic' => function ($q) {
            $q->select('id','name','physican_id')->with(['physican'=>function($q){
                $q->select('id');
            }]);
        }, 'region', 'region.city'])->first();
        $doctors['data'] = Physican::select('id', 'name')->get();
        $cities['data'] = City::select()->get();
        return view('dashboard.address.edit', compact('address', 'doctors', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAddressRequest $request, $id)
    {
        $address['street'] = $request->only('street_ar', 'street_en');
        $address['building'] = $request->only('building_ar', 'building_en');
        $address['floor'] = $request->floor;
        $address['apartno'] = $request->apartno;
        $address['landmark'] = $request->only('landmark_ar', 'landmark_en');
        $address['region_id'] = $request->region_id;
        $updateAddress = Address::where('id', $id)->update($address);

        if (!$updateAddress)
            return redirect()->route('addresses.edit', ['address' => $id])->with('error', __('website\includes\sessionDisplay.wrong'));

        return redirect()->route('addresses.index')->with('success', 'Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address = Address::find($id);

        if (!$address)
            return redirect()->route('addresses.index')->with('error', __('website\includes\sessionDisplay.wrong'));

        $address->delete();
        return redirect()->route('addresses.index')->with('success', 'Successfully deleted!');
    }
}

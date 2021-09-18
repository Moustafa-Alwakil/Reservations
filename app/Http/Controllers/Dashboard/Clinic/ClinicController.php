<?php

namespace App\Http\Controllers\Dashboard\Clinic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Clinic\StoreClinicRequest;
use App\Http\Requests\Dashboard\Clinic\UpdateClinicRequest;
use App\Models\Clinic;
use App\Models\Physican;
use App\Traits\uploadTrait;

class ClinicController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:read')->only('index');
        $this->middleware('permission:create')->only('create','store');
        $this->middleware('permission:update')->only('edit','update');
        $this->middleware('permission:delete')->only('destroy');
    }

    use uploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clinics = Clinic::select()->with(['physican' => function ($q) {
            $q->select('id', 'name');
        }])->get();
        return view('dashboard.clinic.index', compact('clinics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors = Physican::select('id', 'name')->get();
        return view('dashboard.clinic.create', compact('doctors'));
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
        $clinic['review'] = $request->review;

        $license = $this->uploadPhoto(rand(0, 9), $request->license, 'clinics-licenses');
        if (!$license)
            return redirect()->route('clinics.create')->with('error', 'Something went wrong, please try again.');

        $clinic['license'] = $license;
        $clinic['physican_id'] = $request->physican_id;
        $storeClinic = Clinic::create($clinic);

        if (!$storeClinic)
            return redirect()->route('clinics.create')->with('error', 'Something went wrong, please try again.');

        return redirect()->route('clinics.index')->with('success', 'The data has been saved successfully.');
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
        $clinic = Clinic::where('id', $id)->with(['physican' => function ($q) {
            $q->select('id');
        }])->first();
        $doctors = Physican::select('id', 'name')->get();
        return view('dashboard.clinic.edit', compact('clinic', 'doctors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClinicRequest $request, $id)
    {
        $clinic['name'] = $request->only('name_ar', 'name_en');
        $clinic['phone'] = $request->phone;
        $clinic['status'] = $request->status;
        $clinic['review'] = $request->review;

        if ($request->has('license')) {

            $file = (explode("clinics-licenses/", Clinic::select('license')->where('id', $id)->first()->license));
            $path = public_path('images\clinics-licenses\\' . $file[1]);
            $deleteLicense = $this->deletePhoto($path);

            if (!$deleteLicense)
                return redirect()->back()->with('error', 'Something went wrong, please try again.');

            $license = $this->uploadPhoto(rand(0, 9), $request->license, 'clinics-licenses');
            if (!$license)
                return redirect()->back()->with('error', 'Something went wrong, please try again.');

            $clinic['license'] = $license;
        }

        $clinic['physican_id'] = $request->physican_id;
        $storeClinic = Clinic::where('id', $id)->update($clinic);

        if (!$storeClinic)
            return redirect()->back()->with('error', 'Something went wrong, please try again.');

        return redirect()->route('clinics.index')->with('success', 'The data has been saved successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clinic = Clinic::find($id);

        if (!$clinic)
            return redirect()->route('clinics.index')->with('error', __('website\includes\sessionDisplay.wrong'));

        $file = (explode("clinics-licenses/", Clinic::select('license')->where('id', $id)->first()->license));
        $path = public_path('images\clinics-licenses\\' . $file[1]);
        $deleteLicense = $this->deletePhoto($path);

        if (!$deleteLicense)
            return redirect()->route('clinics.index')->with('error', 'Something went wrong, please try again.');
        $clinic->delete();
        return redirect()->route('clinics.index')->with('success', 'Successfully deleted!');
    }
}

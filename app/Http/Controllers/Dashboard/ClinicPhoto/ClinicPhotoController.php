<?php

namespace App\Http\Controllers\Dashboard\ClinicPhoto;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ClinicPhoto\StoreClinicPhotoRequest;
use App\Http\Requests\Dashboard\ClinicPhoto\UpdateClinicPhotoRequest;
use App\Models\Clinic;
use App\Models\Clinicphoto;
use App\Models\Physican;
use App\Traits\uploadTrait;
use Illuminate\Support\Facades\Auth;

class ClinicPhotoController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:read')->only('index');
        $this->middleware('permission:create')->only('create','store');
        $this->middleware('permission:update')->only('edit','update');
        $this->middleware('permission:delete')->only('edit','destroy');
    }

    use uploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clinicPhotos = Clinicphoto::select()->with(['clinic' => function ($q) {
            $q->select('id', 'name', 'physican_id')->with(['physican' => function ($q) {
                $q->select('id', 'name');
            }]);
        }])->get();
        return view('dashboard.clinicPhoto.index', compact('clinicPhotos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors['data'] = Physican::select('id', 'name')->get();
        return view('dashboard.clinicPhoto.create', compact('doctors'));
    }

    public function getClinics($clinicphoto, $id)
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
    public function store(StoreClinicPhotoRequest $request)
    {
        if ($request->has('photo')) {
            $i = 1;
            foreach ($request->photo as $photo) {
                $clinicPhoto = $this->uploadPhoto(Auth::guard('admin')->user()->id, $photo, 'clinics-photos', $i);

                if (!$clinicPhoto)
                    return redirect()->route('clinicphotos.create')->with('error', 'Something went wrong, please try again.');

                $storeClinicPhoto = Clinicphoto::create(['photo' => $clinicPhoto, 'clinic_id' => $request->clinic_id]);

                if (!$storeClinicPhoto)
                    return redirect()->route('clinicphotos.create')->with('error', 'Something went wrong, please try again.');

                $i++;
            }
            return redirect()->route('clinicphotos.index')->with('success', 'The data has been saved successfully.');
        }
        return redirect()->route('clinicphotos.create')->with('error', 'Something went wrong, please try again.');
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
        $clinicPhoto = Clinicphoto::where('id',$id)->with(['clinic' => function ($q) {
            $q->select('id', 'name', 'physican_id')->with(['physican' => function ($q) {
                $q->select('id', 'name');
            }]);
        }])->first();
        $doctors['data'] = Physican::select('id', 'name')->get();
        return view('dashboard.clinicPhoto.edit', compact('clinicPhoto','doctors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClinicPhotoRequest $request, $id)
    {
        $data = $request->except('_token', '_method', 'photo','doctor');

        if ($request->has('photo')) {
            $photo = $this->uploadPhoto(Auth::guard('admin')->user()->id, $request->photo, 'clinics-photos');
            if (!$photo)
                return redirect()->route('clinicphotos.edit', ['clinicphoto' => $id])->with('error', 'Something went wrong, please try again.');

            $clinicPhoto = Clinicphoto::where('id', $id)->first();
            $file = (explode("clinics-photos/", $clinicPhoto->photo));
            $path = public_path('images\clinics-photos\\' . $file[1]);
            $delete = $this->deletePhoto($path);

            if (!$delete)
                return redirect()->route('clinicphotos.index')->with('error', 'Something went wrong, please try again.');

            $data['photo'] = $photo;
        }

        $data['clinic_id'] = $request->clinic_id;

        $updateClinicPhoto = Clinicphoto::where('id', $id)->update($data);
        if (!$updateClinicPhoto)
            return redirect()->route('clinicphotos.edit', ['clinicphoto' => $id])->with('error', 'Something went wrong, please try again.');

        return redirect()->route('clinicphotos.index')->with('success', 'The data has been saved successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clinicPhoto = Clinicphoto::find($id);


        if (!$clinicPhoto)
            return redirect()->route('certificates.index')->with('error', __('website\includes\sessionDisplay.wrong'));

        $file = (explode("clinics-photos/", $clinicPhoto->photo));
        $path = public_path('images\clinics-photos\\' . $file[1]);
        $delete = $this->deletePhoto($path);

        if (!$delete)
            return redirect()->route('clinicphotos.index')->with('error', 'Something went wrong, please try again.');

        $clinicPhoto->delete();
        return redirect()->route('clinicphotos.index')->with('success', 'Successfully deleted!');
    }
}

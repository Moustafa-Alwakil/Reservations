<?php

namespace App\Http\Controllers\Dashboard\Certificate;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Certificate\StoreCertificateRequest;
use App\Http\Requests\Dashboard\Certificate\UpdateCertificateRequest;
use App\Models\Certificate;
use App\Models\Physican;
use Illuminate\Http\Request;
use App\Traits\uploadTrait;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    use uploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $certificates = Certificate::select()->with(['physican' => function ($q) {
            $q->select('id', 'name');
        }])->get();
        return view('dashboard.certificate.index', compact('certificates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors = Physican::select('id', 'name')->get();
        return view('dashboard.certificate.create', compact('doctors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCertificateRequest $request)
    {
        $data = $request->except('_token', 'photo');

        $photo = $this->uploadPhoto(Auth::guard('admin')->user()->id, $request->photo, 'certificates');
        if (!$photo)
            return redirect()->route('certificates.create')->with('error', 'Something went wrong, please try again.');

        $data['photo'] = $photo;
        $data['physican_id'] = $request->physican_id;

        $certificate = Certificate::create($data);
        if (!$certificate)
            return redirect()->route('certificates.create')->with('error', 'Something went wrong, please try again.');

        return redirect()->route('certificates.index')->with('success', 'The data has been saved successfully.');
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
        $certificate = Certificate::where('id', $id)->with(['physican' => function ($q) {
            $q->select('id', 'name');
        }])->first();
        $doctors = Physican::select('id', 'name')->get();

        return view('dashboard.certificate.edit', compact('certificate', 'doctors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCertificateRequest $request, $id)
    {
        $data = $request->except('_token', '_method', 'photo');

        if ($request->has('photo')) {
            $photo = $this->uploadPhoto(Auth::guard('admin')->user()->id, $request->photo, 'certificates');
            if (!$photo)
                return redirect()->route('certificates.edit', ['certificate' => $id])->with('error', 'Something went wrong, please try again.');

            $certificate = Certificate::where('id', $id)->first();
            $file = (explode("certificates/", $certificate->photo));
            $path = public_path('images\certificates\\' . $file[1]);
            $delete = $this->deletePhoto($path);

            if (!$delete)
                return redirect()->route('certificates.index')->with('error', 'Something went wrong, please try again.');

            $data['photo'] = $photo;
        }

        $data['physican_id'] = $request->physican_id;

        $Updatecertificate = Certificate::where('id', $id)->update($data);
        if (!$Updatecertificate)
            return redirect()->route('certificates.edit', ['certificate' => $id])->with('error', 'Something went wrong, please try again.');

        return redirect()->route('certificates.index')->with('success', 'The data has been saved successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $certificate = Certificate::find($id);

        if (!$certificate)
            return redirect()->route('certificates.index')->with('error', __('website\includes\sessionDisplay.wrong'));

        $file = (explode("certificates/", $certificate->photo));
        $path = public_path('images\certificates\\' . $file[1]);
        $delete = $this->deletePhoto($path);

        if (!$delete)
            return redirect()->route('certificate.index')->with('error', 'Something went wrong, please try again.');

        $certificate->delete();
        return redirect()->route('certificates.index')->with('success', 'Successfully deleted!');
    }
}

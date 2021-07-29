<?php

namespace App\Http\Controllers\Website\Doctor\Certificate;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Doctor\Certificate\DestroyCertificateRequest;
use App\Http\Requests\Website\Doctor\Certificate\StoreCertificateRequest;
use App\Models\Certificate;
use App\Traits\uploadTrait;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    use uploadTrait;

    public function index()
    {
        $certificates = Certificate::Where('physican_id',  Auth::guard('doc')->user()->id)->get();
        return view('website.doctor.certificate.index',compact('certificates'));
    }

    public function store(StoreCertificateRequest $request)
    {
        $data = $request->except('_token', 'photo');

        $photo = $this->uploadPhoto(1,Auth::guard('doc')->user()->id, $request->photo, 'certificates');
        if (!$photo)
            return redirect()->route('doctor.certificate')->with('error', 'Something went wrong, please try again.');

        $data['photo'] = $photo;
        $data['physican_id'] = Auth::guard('doc')->user()->id;

        $certificate = Certificate::create($data);
        if (!$certificate)
            return redirect()->route('doctor.certificate')->with('error', 'Something went wrong, please try again.');

        return redirect()->route('doctor.certificate')->with('success', 'The data has been saved successfully.');
    }

    public function destroy(DestroyCertificateRequest $request)
    {
        $certificate = Certificate::where('id', $request->id)->where('physican_id', Auth::guard('doc')->user()->id)->first();
        if (!$certificate)
            return redirect()->route('doctor.certificate')->with('error', 'Something went wrong, please try again.');

        $file = (explode("certificates/", $certificate->photo));
        $path = public_path('images\certificates\\' . $file[1]);
        $delete = $this->deletePhoto($path);
        if (!$delete)
            return redirect()->route('doctor.certificate')->with('error', 'Something went wrong, please try again.');

        $certificate->delete();
        return redirect()->route('doctor.certificate')->with('success', 'Successfully deleted.');
    }
}

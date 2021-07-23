<?php

namespace App\Http\Controllers\Website\Doctor\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Doctor\Profile\DestroyCertificateRequest;
use App\Http\Requests\Website\Doctor\Profile\StoreCertificateRequest;
use App\Models\Certificate;
use App\Traits\generalTrait;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    use generalTrait;

    public function index()
    {
        $certificates = Certificate::Where('physican_id',  Auth::guard('doc')->user()->id)->get();
        if (isset($certificates[0])) {
            return view('website.doctor.profile.certificate', compact('certificates'));
        }
        return view('website.doctor.profile.certificate');
    }

    public function store(StoreCertificateRequest $request)
    {
        $request->validated();

        $data = $request->except('_token', 'photo');
        $photo = $this->uploadPhoto(Auth::guard('doc')->user()->id, $request->photo, 'certificates');

        $data['photo'] = $photo;
        $data['physican_id'] = Auth::guard('doc')->user()->id;

        $certificate = Certificate::create($data);
        if (!$certificate)
            return redirect()->route('doctor.certificate')->with('error', 'Something went wrong, please try again.');

        return redirect()->route('doctor.certificate')->with('success', 'The data has been saved successfully.');
    }

    public function destroy(DestroyCertificateRequest $request)
    {
        $request->validated();

        $data = $request->except('_token', '_method');

        $certificate = Certificate::where('id', $data['id'])->where('physican_id', Auth::guard('doc')->user()->id)->first();
        if(!$certificate){
            return redirect()->route('doctor.certificate')->with('error', 'Something went wrong, please try again.');
        }
        $arr = (explode("certificates/",$certificate->photo));
        $path = public_path('images\certificates\\'.$arr[1]);
        $delete = $this->deletePhoto($path);
        if(!$delete){
            return redirect()->route('doctor.certificate')->with('error', 'Something went wrong, please try again.');
        }
        $certificate->delete();
        return redirect()->route('doctor.certificate')->with('success', 'Successfully deleted.');
    }
}

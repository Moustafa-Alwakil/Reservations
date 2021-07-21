<?php

namespace App\Http\Controllers\Website\Doctor\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Doctor\Profile\StoreInfoRequest;
use App\Http\Requests\Website\Doctor\Profile\UpdateInfoRequest;
use App\Models\Info;
use App\Traits\generalTrait;
use Illuminate\Support\Facades\Auth;

class InfoController extends Controller
{
    use generalTrait;

    public function index()
    {
        if ($info = Info::firstWhere('physican_id',  Auth::guard('doc')->user()->id)) {
            return view('website.doctor.profile.info', compact('info'));
        }
        return view('website.doctor.profile.info');
    }

    public function store(StoreInfoRequest $request)
    {

        $request->validated();

        $request['about'] = $request->only('about_ar', 'about_en');

        $photo = $this->uploadPhoto(Auth::guard('doc')->user()->id, $request->photo, 'docphotos');
        $license = $this->uploadPhoto(Auth::guard('doc')->user()->id, $request->license, 'licenses');

        $data = $request->except('about_ar', 'about_en', '_token', 'photo', 'license');

        $data['photo'] = $photo;
        $data['license'] = $license;
        $data['physican_id'] = Auth::guard('doc')->user()->id;

        $info = Info::create($data);

        if (!$info)
            return redirect()->route('doctor.info')->with('error', 'Something went wrong, please try again.');

        return redirect()->route('doctor.info')->with('success', 'The data has been saved successfully.');
    }

    public function update(UpdateInfoRequest $request)
    {
        $request->validated();

        $request['about'] = $request->only('about_ar', 'about_en');
        $data = $request->except('about_ar', 'about_en', '_token', '_method');

        if ($request->has('photo')) {
            $photo = $this->uploadPhoto(Auth::guard('doc')->user()->id, $request->photo, 'docphotos');
            if ($photo) {
                $info = Info::firstWhere('physican_id',  Auth::guard('doc')->user()->id);
                $arr = (explode("docphotos/",$info->photo));
                $path = public_path('images\docphotos\\'.$arr[1]);
                $this->deletePhoto($path);
            }
            $data['photo'] = $photo;
        }
        if ($request->has('license')) {
            $license = $this->uploadPhoto(Auth::guard('doc')->user()->id, $request->license, 'licenses');
            if ($license) {
                $info = Info::firstWhere('physican_id',  Auth::guard('doc')->user()->id);
                $arr = (explode("licenses/",$info->license));
                $path = public_path('images\licenses\\'.$arr[1]);
                $this->deletePhoto($path);
            }
            $data['license'] = $license;
        }

        $info = Info::where('physican_id', Auth::guard('doc')->user()->id)->update($data);

        if (!$info)
            return redirect()->route('doctor.info')->with('error', 'Something went wrong, please try again.');

        return redirect()->route('doctor.info')->with('success', 'The data has been updated successfully.');
    }
}

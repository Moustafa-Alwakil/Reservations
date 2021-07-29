<?php

namespace App\Http\Controllers\Website\Doctor\Info;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Doctor\Info\StoreInfoRequest;
use App\Http\Requests\Website\Doctor\Info\UpdateInfoRequest;
use App\Models\Department;
use App\Models\Info;
use App\Models\Physican;
use App\Traits\uploadTrait;
use Illuminate\Support\Facades\Auth;

class InfoController extends Controller
{
    use uploadTrait;

    public function index()
    {
        $departments = Department::select('id', 'name')->orderby('name')->where('status', 1)->get();
        $info = Info::firstWhere('physican_id',  Auth::guard('doc')->user()->id);

        return view('website.doctor.info.index', compact('departments', 'info'));
    }

    public function store(StoreInfoRequest $request)
    {
        $request['about'] = $request->only('about_ar', 'about_en');

        $photo = $this->uploadPhoto(1,Auth::guard('doc')->user()->id, $request->photo, 'docphotos');
        if (!$photo)
            return redirect()->route('doctor.info')->with('error', 'Something went wrong, please try again.');

        $license = $this->uploadPhoto(1,Auth::guard('doc')->user()->id, $request->license, 'doclicenses');
        if (!$license)
            return redirect()->route('doctor.info')->with('error', 'Something went wrong, please try again.');

        $data = $request->except('about_ar', 'about_en', '_token', 'photo', 'license', 'department_id');

        $data['photo'] = $photo;
        $data['license'] = $license;
        $data['physican_id'] = Auth::guard('doc')->user()->id;

        $info = Info::create($data);
        $department_id = Physican::where('id', Auth::guard('doc')->user()->id)->update(['department_id' => $request->department_id]);

        if (!$info || !$department_id)
            return redirect()->route('doctor.info')->with('error', 'Something went wrong, please try again.');

        return redirect()->route('doctor.info')->with('success', 'The data has been saved successfully.');
    }

    public function update(UpdateInfoRequest $request)
    {
        $request['about'] = $request->only('about_ar', 'about_en');
        $data = $request->except('about_ar', 'about_en', '_token', '_method', 'department_id');

        if ($request->has('photo')) {
            $photo = $this->uploadPhoto(1,Auth::guard('doc')->user()->id, $request->photo, 'docphotos');
            if ($photo) {
                $info = Info::firstWhere('physican_id',  Auth::guard('doc')->user()->id);
                $file = (explode("docphotos/", $info->photo));
                $path = public_path('images\docphotos\\' . $file[1]);
                $delete = $this->deletePhoto($path);
                if (!$delete) {
                    return redirect()->route('doctor.info')->with('error', 'Something went wrong, please try again.');
                }
            }
            $data['photo'] = $photo;
        }
        if ($request->has('license')) {
            $license = $this->uploadPhoto(1,Auth::guard('doc')->user()->id, $request->license, 'doclicenses');
            if ($license) {
                $info = Info::firstWhere('physican_id',  Auth::guard('doc')->user()->id);
                $file = (explode("doclicenses/", $info->license));
                $path = public_path('images\doclicenses\\' . $file[1]);
                $delete = $this->deletePhoto($path);

                if (!$delete)
                    return redirect()->route('doctor.info')->with('error', 'Something went wrong, please try again.');

                $status = Physican::where('id', Auth::guard('doc')->user()->id)->update(['status' => 2]);

                if (!$status)
                    return redirect()->route('doctor.info')->with('error', 'Something went wrong, please try again.');
            }
            $data['license'] = $license;
        }

        $info = Info::where('physican_id', Auth::guard('doc')->user()->id)->update($data);
        if (Auth::guard('doc')->user()->department_id != $request->department_id) {
            $department_id = Physican::where('id', Auth::guard('doc')->user()->id)->update(['department_id' => $request->department_id, 'status' => 2]);
            if (!$department_id)
                return redirect()->route('doctor.info')->with('error', 'Something went wrong, please try again.');
        }
        if (!$info)
            return redirect()->route('doctor.info')->with('error', 'Something went wrong, please try again.');

        return redirect()->route('doctor.info')->with('success', 'The data has been updated successfully.');
    }
}
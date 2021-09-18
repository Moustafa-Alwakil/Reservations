<?php

namespace App\Http\Controllers\Dashboard\Info;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Info\StoreInfoRequest;
use App\Http\Requests\Dashboard\Info\UpdateInfoRequest;
use App\Models\Info;
use App\Models\Physican;
use App\Traits\uploadTrait;
use Illuminate\Support\Facades\Auth;

class InfoController extends Controller
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
        $infos = Info::select()->with(['physican' => function ($q) {
            $q->select('id', 'name');
        }])->get();
        return view('dashboard.info.index', compact('infos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors = Physican::select('id', 'name')->get();
        return view('dashboard.info.create', compact('doctors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInfoRequest $request)
    {
        $request['about'] = $request->only('about_ar', 'about_en');

        $photo = $this->uploadPhoto(Auth::guard('admin')->user()->id, $request->photo, 'docphotos');

        if (!$photo)
            return redirect()->route('infos.create')->with('error', 'Something went wrong, please try again.');

        $license = $this->uploadPhoto(Auth::guard('admin')->user()->id, $request->license, 'doclicenses');

        if (!$license)
            return redirect()->route('infos.create')->with('error', 'Something went wrong, please try again.');

        $data = $request->except('about_ar', 'about_en', '_token', 'photo', 'license');

        $data['photo'] = $photo;
        $data['license'] = $license;;

        $info = Info::create($data);

        if (!$info)
            return redirect()->route('infos.create')->with('error', 'Something went wrong, please try again.');

        return redirect()->route('infos.index')->with('success', 'The data has been saved successfully.');
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
        $info = Info::where('id', $id)->with(['physican' => function ($q) {
            $q->select('id', 'name');
        }])->first();
        $doctors = Physican::select('id', 'name')->get();
        return view('dashboard.info.edit', compact('info', 'doctors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInfoRequest $request, $id)
    {
        $request['about'] = $request->only('about_ar', 'about_en');
        $data = $request->except('about_ar', 'about_en', '_token', '_method');

        if ($request->has('photo')) {
            $photo = $this->uploadPhoto(Auth::guard('admin')->user()->id, $request->photo, 'docphotos');
            if ($photo) {
                $info = Info::firstWhere('id', $id);
                $file = (explode("docphotos/", $info->photo));
                $path = public_path('images\docphotos\\' . $file[1]);
                $delete = $this->deletePhoto($path);
                if (!$delete) {
                    return redirect()->route('infos.edit', ['info' => $info->id])->with('error', 'Something went wrong, please try again.');
                }
            }
            $data['photo'] = $photo;
        }
        if ($request->has('license')) {
            $license = $this->uploadPhoto(Auth::guard('admin')->user()->id, $request->license, 'doclicenses');
            if ($license) {
                $info = Info::firstWhere('id', $id);
                $file = (explode("doclicenses/", $info->license));
                $path = public_path('images\doclicenses\\' . $file[1]);
                $delete = $this->deletePhoto($path);

                if (!$delete)
                    return redirect()->route('infos.edit', ['info' => $info->id])->with('error', 'Something went wrong, please try again.');
            }
            $data['license'] = $license;
        }

        $info = Info::where('id', $id)->update($data);
        if (!$info)
            return redirect()->route('infos.edit', ['info' => $info->id])->with('error', 'Something went wrong, please try again.');

        return redirect()->route('infos.index')->with('success', 'The data has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $info = Info::find($id);

        if (!$info)
            return redirect()->route('infos.index')->with('error', __('website\includes\sessionDisplay.wrong'));

        $file = (explode("docphotos/", $info->photo));
        $path = public_path('images\docphotos\\' . $file[1]);
        $deletePhoto = $this->deletePhoto($path);

        if (!$deletePhoto)
            return redirect()->route('infos.index')->with('error', 'Something went wrong, please try again.');

        $file = (explode("doclicenses/", $info->license));
        $path = public_path('images\doclicenses\\' . $file[1]);
        $deleteLicense = $this->deletePhoto($path);

        if (!$deleteLicense)
            return redirect()->route('infos.index')->with('error', 'Something went wrong, please try again.');

        $info->delete();
        return redirect()->route('infos.index')->with('success', 'Successfully deleted!');
    }
}

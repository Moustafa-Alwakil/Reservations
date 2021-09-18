<?php

namespace App\Http\Controllers\Dashboard\Service;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Service\StoreServiceRequest;
use App\Http\Requests\Dashboard\Update\UpdateServiceRequest;
use App\Models\Department;
use App\Models\Service;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read')->only('index');
        $this->middleware('permission:create')->only('create','store');
        $this->middleware('permission:update')->only('edit','update');
        $this->middleware('permission:delete')->only('edit','destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::select()->with(['department' => function ($q) {
            $q->select('id', 'name');
        }])->get();
        return view('dashboard.service.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::select('id', 'name')->get();
        return view('dashboard.service.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceRequest $request)
    {
        $data = $request->except('_token', 'name_ar', 'name_en');
        $data['name'] = $request->only('name_ar', 'name_en');

        $region = Service::create($data);

        if (!$region)
            return redirect()->route('services.create')->with('error', 'Something went wrong, please try again.');

        return redirect()->route('services.index')->with('success', 'The data has been saved successfully.');
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
        $service = Service::where('id',$id)->with(['department' => function ($q) {
            $q->select('id', 'name');
        }])->first();
        $departments = Department::select('id', 'name')->get();
        return view('dashboard.service.edit', compact('service','departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceRequest $request, $id)
    {
        $data = $request->except('_token', 'name_ar', 'name_en','_method');
        $data['name'] = $request->only('name_ar', 'name_en');

        $service = Service::where('id',$id)->update($data);

        if (!$service)
            return redirect()->route('services.edit',['service'=>$id])->with('error', 'Something went wrong, please try again.');

        return redirect()->route('services.index')->with('success', 'The data has been saved successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);

        if (!$service)
            return redirect()->route('services.index')->with('error', __('website\includes\sessionDisplay.wrong'));

        $service->delete();
        return redirect()->route('services.index')->with('success', 'Successfully deleted!');
    }
}

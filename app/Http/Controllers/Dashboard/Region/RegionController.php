<?php

namespace App\Http\Controllers\Dashboard\Region;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Region\StoreRegionRequest;
use App\Http\Requests\Dashboard\Region\UpdateRegionRequest;
use App\Models\City;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions = Region::select()->with('city')->get();
        return view('dashboard.region.index', compact('regions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::select()->get();
        return view('dashboard.region.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRegionRequest $request)
    {
        $data = $request->except('_token', 'name_ar', 'name_en');
        $data['name'] = $request->only('name_ar', 'name_en');

        $region = Region::create($data);

        if (!$region)
            return redirect()->route('regions.create')->with('error', 'Something went wrong, please try again.');

        return redirect()->route('regions.index')->with('success', 'The data has been saved successfully.');
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
        $region = Region::where('id',$id)->with('city')->first();
        $cities = City::select()->get();
        return view('dashboard.region.edit', compact('region', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRegionRequest $request, $id)
    {
        $data = $request->except('_token', 'name_ar', 'name_en','_method');
        $data['name'] = $request->only('name_ar', 'name_en');

        $region = Region::where('id',$id)->update($data);

        if (!$region)
            return redirect()->route('regions.edit',['region'=>$id])->with('error', 'Something went wrong, please try again.');

        return redirect()->route('regions.index')->with('success', 'The data has been saved successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $region = Region::find($id);

        if (!$region)
            return redirect()->route('regions.index')->with('error', __('website\includes\sessionDisplay.wrong'));

        $region->delete();
        return redirect()->route('regions.index')->with('success', 'Successfully deleted!');
    }
}

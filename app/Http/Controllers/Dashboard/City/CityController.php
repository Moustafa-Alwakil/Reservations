<?php

namespace App\Http\Controllers\Dashboard\City;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\City\StoreCityRequest;
use App\Http\Requests\Dashboard\City\UpdateCityRequest;
use App\Models\City;

class CityController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:read')->only('index');
        $this->middleware('permission:create')->only('create', 'store');
        $this->middleware('permission:update')->only('edit', 'update');
        $this->middleware('permission:delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::select()->get();
        return view('dashboard.city.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.city.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCityRequest $request)
    {
        $data = $request->except('_token', 'name_ar', 'name_en');
        $data['name'] = $request->only('name_ar', 'name_en');

        $city = City::create($data);

        if (!$city)
            return redirect()->route('cities.create')->with('error', 'Something went wrong, please try again.');

        return redirect()->route('cities.index')->with('success', 'The data has been saved successfully.');
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
        $city = City::where('id', $id)->first();
        return view('dashboard.city.edit', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCityRequest $request, $id)
    {
        $data = $request->except('_token', 'name_ar', 'name_en', '_method');
        $data['name'] = $request->only('name_ar', 'name_en');

        $city = City::where('id', $id)->update($data);

        if (!$city)
            return redirect()->route('cities.edit', ['city' => $city->id])->with('error', 'Something went wrong, please try again.');

        return redirect()->route('cities.index')->with('success', 'The data has been saved successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = City::find($id);

        if (!$city)
            return redirect()->route('cities.index')->with('error', __('website\includes\sessionDisplay.wrong'));

        $city->delete();
        return redirect()->route('cities.index')->with('success', 'Successfully deleted!');
    }
}

<?php

namespace App\Http\Controllers\Dashboard\Experience;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Experience\StoreExperienceRequest;
use App\Http\Requests\Dashboard\Experience\UpdateExperienceRequest;
use App\Models\Experience;
use App\Models\Physican;

class ExperienceController extends Controller
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
        $experiences = Experience::select()->with(['physican' => function ($q) {
            $q->select('id', 'name');
        }])->get();
        return view('dashboard.experience.index', compact('experiences'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors = Physican::select('id', 'name')->get();
        return view('dashboard.experience.create', compact('doctors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExperienceRequest $request)
    {
        $request['title'] = $request->only('title_ar', 'title_en');
        $request['place'] = $request->only('place_ar', 'place_en');
        $data = $request->except('_token', 'place_ar', 'place_en', 'title_ar', 'title_en');

        $experience = Experience::create($data);
        if (!$experience)
            return redirect()->route('experiences.create')->with('error', 'Something wen Wrong.');

        return redirect()->route('experiences.index')->with('success', 'Data saved successfully.');
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
        $experience = Experience::where('id', $id)->with(['physican' => function ($q) {
            $q->select('id', 'name');
        }])->first();
        $doctors = Physican::select('id', 'name')->get();
        return view('dashboard.experience.edit', compact('experience', 'doctors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExperienceRequest $request, $id)
    {
        $request['title'] = $request->only('title_ar', 'title_en');
        $request['place'] = $request->only('place_ar', 'place_en');
        $data = $request->except('_token', 'place_ar', 'place_en', 'title_ar', 'title_en', '_method');

        $experience = Experience::where('id',$id)->update($data);
        if (!$experience)
            return redirect()->route('experiences.edit', ['experience' => $id])->with('error', 'Something wen Wrong.');

        return redirect()->route('experiences.index')->with('success', 'Data saved successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $experience = Experience::find($id);

        if (!$experience)
            return redirect()->route('experiences.index')->with('error', __('website\includes\sessionDisplay.wrong'));

        $experience->delete();
        return redirect()->route('experiences.index')->with('success', 'Successfully deleted!');
    }
}

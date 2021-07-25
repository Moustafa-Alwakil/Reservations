<?php

namespace App\Http\Controllers\Website\Doctor\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Doctor\Profile\DestroyExperienceRequest;
use App\Http\Requests\Website\Doctor\Profile\StoreExperienceRequest;
use App\Http\Requests\Website\Doctor\Profile\UpdateExperienceRequest;
use App\Models\Experience;
use App\Traits\generalTrait;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    use generalTrait;

    public function index()
    {
        $experiences = Experience::Where('physican_id',  Auth::guard('doc')->user()->id)->get();
        if (isset($experiences[0]))
            return view('website.doctor.profile.experience', compact('experiences'));

        return view('website.doctor.profile.experience');
    }

    public function store(StoreExperienceRequest $request)
    {
        $request->validated();

        $request['title'] = $request->only('title_ar', 'title_en');
        $request['place'] = $request->only('place_ar', 'place_en');
        $data = $request->except('_token', 'place_ar', 'place_en', 'title_ar', 'title_en');
        $data['physican_id'] = Auth::guard('doc')->user()->id;

        $experience = Experience::create($data);
        if (!$experience)
            return redirect()->route('doctor.experience')->with('error', 'Something wen Wrong.');

        return redirect()->route('doctor.experience')->with('success', 'Data saved successfully.');
    }

    public function edit($id)
    {
        $experience = Experience::where('id', $id)->where('physican_id', Auth::guard('doc')->user()->id)->first();
        if (!$experience)
            return redirect()->route('doctor.experience')->with('error', 'Something went wrong, please try again.');

        return view('website.doctor.profile.experience', compact('experience'));
    }

    public function Update(UpdateExperienceRequest $request)
    {
        $request->validated();

        $request['title'] = $request->only('title_ar', 'title_en');
        $request['place'] = $request->only('place_ar', 'place_en');
        $data = $request->except('_token', 'place_ar', 'place_en', 'title_ar', 'title_en','_method');

        $experience = Experience::where('physican_id',Auth::guard('doc')->user()->id)->update($data);
        if (!$experience)
            return redirect()->back()->with('error', 'Something wen Wrong.');

        return redirect()->route('doctor.experience')->with('success', 'Data saved successfully.');
    }

    public function destroy(DestroyExperienceRequest $request)
    {
        $request->validated();

        $experience = Experience::where('id', $request->id)->where('physican_id', Auth::guard('doc')->user()->id)->first();
        if (!$experience)
            return redirect()->route('doctor.experience')->with('error', 'Something went wrong, please try again.');

        $experience->delete();
        return redirect()->route('doctor.experience')->with('success', 'Successfully deleted.');
    }
}

<?php

namespace App\Http\Controllers\Website\Doctor\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Doctor\Profile\DestroyExperienceRequest;
use App\Http\Requests\Website\Doctor\Profile\StoreExperienceRequest;
use App\Models\Experience;
use App\Traits\generalTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

    public function destroy(DestroyExperienceRequest $request)
    {
        $request->validated();

        $data = $request->except('_token', '_method');

        $certificate = Experience::where('id', $data['id'])->where('physican_id', Auth::guard('doc')->user()->id)->first();
        if (!$certificate) {
            return redirect()->route('doctor.experience')->with('error', 'Something went wrong, please try again.');
        }
        $certificate->delete();
        return redirect()->route('doctor.experience')->with('success', 'Successfully deleted.');
    }
}

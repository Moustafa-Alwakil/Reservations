<?php

namespace App\Http\Controllers\Dashboard\Workday;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Workday\StoreWorkdayRequest;
use App\Http\Requests\Dashboard\Workday\UpdateWorkdayRequest;
use App\Models\Clinic;
use App\Models\Physican;
use App\Models\Workday;
use Illuminate\Http\Request;

class WorkdayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workdays = Workday::select()->with(['clinic'=>function($q){
            $q->select('id','name','physican_id')->with(['physican'=>function($q){
                $q->select('id','name');
            }]);
        }])->get();
        return view('dashboard.workday.index',compact('workdays'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors['data'] = Physican::select('id', 'name')->get();
        return view('dashboard.workday.create',compact('doctors'));
    }

    public function getClinics($workday, $id)
    {
        $clinics['data'] = Clinic::select('id', 'name', 'physican_id')->where('physican_id', $id)->get();
        return response()->json($clinics);
    }

    public function getClinic($id)
    {
        $clinics['data'] = Clinic::select('id', 'name', 'physican_id')->where('physican_id', $id)->get();
        return response()->json($clinics);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWorkdayRequest $request)
    {
        $data['available']['saturday'] = $request->only('sat_status', 'sat_start_time', 'sat_end_time', 'sat_duration');
        $data['available']['sunday'] = $request->only('sun_status', 'sun_start_time', 'sun_end_time', 'sun_duration');
        $data['available']['monday'] = $request->only('mon_status', 'mon_start_time', 'mon_end_time', 'mon_duration');
        $data['available']['tuesday'] = $request->only('tue_status', 'tue_start_time', 'tue_end_time', 'tue_duration');
        $data['available']['wednesday'] = $request->only('wed_status', 'wed_start_time', 'wed_end_time', 'wed_duration');
        $data['available']['thursday'] = $request->only('thu_status', 'thu_start_time', 'thu_end_time', 'thu_duration');
        $data['available']['friday'] = $request->only('fri_status', 'fri_start_time', 'fri_end_time', 'fri_duration');
        $data ['clinic_id'] = $request->clinic_id;
        $workdays = Workday::create($data);

        if (!$workdays)
            return redirect()->route('workdays.create')->with('error', 'Something went wrong, please try again.');

            return redirect()->route('workdays.index')->with('success', 'The data has been saved successfully.');
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
        $workday = Workday::where('id',$id)->with(['clinic'=>function($q){
            $q->select('id','name','physican_id')->with(['physican'=>function($q){
                $q->select('id','name');
            }]);
        }])->first();
        $doctors['data'] = Physican::select('id', 'name')->get();
        return view('dashboard.workday.edit',compact('workday','doctors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWorkdayRequest $request, $id)
    {
        $data['available']['saturday'] = $request->only('sat_status', 'sat_start_time', 'sat_end_time', 'sat_duration');
        $data['available']['sunday'] = $request->only('sun_status', 'sun_start_time', 'sun_end_time', 'sun_duration');
        $data['available']['monday'] = $request->only('mon_status', 'mon_start_time', 'mon_end_time', 'mon_duration');
        $data['available']['tuesday'] = $request->only('tue_status', 'tue_start_time', 'tue_end_time', 'tue_duration');
        $data['available']['wednesday'] = $request->only('wed_status', 'wed_start_time', 'wed_end_time', 'wed_duration');
        $data['available']['thursday'] = $request->only('thu_status', 'thu_start_time', 'thu_end_time', 'thu_duration');
        $data['available']['friday'] = $request->only('fri_status', 'fri_start_time', 'fri_end_time', 'fri_duration');
        $data ['clinic_id'] = $request->clinic_id;
        $workdays = Workday::where('id',$id)->update($data);

        if (!$workdays)
            return redirect()->route('workdays.edit',['workday'=>$id])->with('error', 'Something went wrong, please try again.');

            return redirect()->route('workdays.index')->with('success', 'The data has been saved successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $workday = Workday::find($id);

        if (!$workday)
            return redirect()->route('workdays.index')->with('error', __('website\includes\sessionDisplay.wrong'));

        $workday->delete();
        return redirect()->route('workdays.index')->with('success', 'Successfully deleted!');
    }
}

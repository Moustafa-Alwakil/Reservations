<?php

namespace App\Http\Controllers\Dashboard\Examfee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Examfee\StoreExamfeeRequest;
use App\Http\Requests\Dashboard\Examfee\UpdateExamfeeRequest;
use App\Models\Clinic;
use App\Models\Examfee;
use App\Models\Physican;

class ExamfeeController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:read')->only('index');
        $this->middleware('permission:create')->only('create','store');
        $this->middleware('permission:update')->only('edit','update');
        $this->middleware('permission:delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $examfees = Examfee::select()->with(['clinic' => function ($q) {
            $q->select('id', 'name', 'physican_id')->with(['physican' => function ($q) {
                $q->select('id', 'name');
            }]);
        }])->get();

        return view('dashboard.examfee.index', compact('examfees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors['data'] = Physican::select('id', 'name')->get();
        return view('dashboard.examfee.create', compact('doctors'));
    }

    public function getClinics($examfee, $id)
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
    public function store(StoreExamfeeRequest $request)
    {
        $examfee = Examfee::create([
            'price' => $request->price,
            'clinic_id' => $request->clinic_id,
        ]);

        if (!$examfee)
            return redirect()->route('examfees.create')->with('error', 'Something went wrong, please try again.');

        return redirect()->route('examfees.index')->with('success', 'The data has been saved successfully.');
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
        $examfee = Examfee::where('id',$id)->with(['clinic' => function ($q) {
            $q->select('id', 'name', 'physican_id')->with(['physican' => function ($q) {
                $q->select('id', 'name');
            }]);
        }])->first();
        $doctors['data'] = Physican::select('id', 'name')->get();
        return view('dashboard.examfee.edit', compact('doctors','examfee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExamfeeRequest $request, $id)
    {
        $examfee = Examfee::where('id',$id)->update([
            'price' => $request->price,
            'clinic_id' => $request->clinic_id,
        ]);

        if (!$examfee)
            return redirect()->route('examfees.edit',['examfee'=>$id])->with('error', 'Something went wrong, please try again.');

        return redirect()->route('examfees.index')->with('success', 'The data has been saved successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $examfee = Examfee::find($id);

        if (!$examfee)
            return redirect()->route('examfees.index')->with('error', __('website\includes\sessionDisplay.wrong'));

        $examfee->delete();
        return redirect()->route('examfees.index')->with('success', 'Successfully deleted!');
    }
}

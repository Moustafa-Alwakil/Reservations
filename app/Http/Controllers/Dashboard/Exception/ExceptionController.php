<?php

namespace App\Http\Controllers\Dashboard\Exception;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Exception\StoreExceptionRequest;
use App\Http\Requests\Dashboard\Exception\UpdateExceptionRequest;
use App\Models\Clinic;
use App\Models\Exception;
use App\Models\Physican;
use Illuminate\Http\Request;

class ExceptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exceptions = Exception::select()->with(['clinic' => function ($q) {
            $q->select('id', 'name', 'physican_id')->with(['physican' => function ($q) {
                $q->select('id', 'name');
            }]);
        }])->get();
        return view('dashboard.exception.index', compact('exceptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors['data'] = Physican::select('id', 'name')->get();
        return view('dashboard.exception.create', compact('doctors'));
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
    public function store(StoreExceptionRequest $request)
    {
        $data = $request->except('_token', 'doctor');
        $exception = Exception::create($data);

        if (!$exception)
            return redirect()->route('exceptions.create')->with('error', 'Something went wrong, please try again.');

        return redirect()->route('exceptions.index')->with('success', 'The data has been saved successfully.');
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
        $exception = Exception::where('id',$id)->with(['clinic' => function ($q) {
            $q->select('id', 'name', 'physican_id')->with(['physican' => function ($q) {
                $q->select('id', 'name');
            }]);
        }])->first();
        $doctors['data'] = Physican::select('id', 'name')->get();
        return view('dashboard.exception.edit', compact('exception','doctors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExceptionRequest $request, $id)
    {
        $data = $request->except('_token', 'doctor','_method');
        $exception = Exception::where('id',$id)->update($data);

        if (!$exception)
            return redirect()->route('exceptions.edit',['exception'=>$id])->with('error', 'Something went wrong, please try again.');

        return redirect()->route('exceptions.index')->with('success', 'The data has been saved successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exception = Exception::find($id);

        if (!$exception)
            return redirect()->route('exceptions.index')->with('error', __('website\includes\sessionDisplay.wrong'));

        $exception->delete();
        return redirect()->route('exceptions.index')->with('success', 'Successfully deleted!');
    }
}

<?php

namespace App\Http\Controllers\Dashboard\ClinicService;

use App\Http\Controllers\Controller;
use App\Models\ClinicService;
use Illuminate\Http\Request;

class ClinicServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clinicServices = ClinicService::select()->with(['clinic'=>function($q){
            $q->select('id','name','physican_id')->with(['physican'=>function($q){
                $q->select('id','name','department_id')->with(['department'=>function($q){
                    $q->select('id','name');
                }]);
            }]);
        }])->get();
        return view('dashboard.clinicService.index',compact('clinicServices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clinicService = ClinicService::find($id);

        if (!$clinicService)
            return redirect()->route('clinicservices.index')->with('error', __('website\includes\sessionDisplay.wrong'));

        $clinicService->delete();
        return redirect()->route('clinicservices.index')->with('success', 'Successfully deleted!');
    }
}

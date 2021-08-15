<?php

namespace App\Http\Controllers\Dashboard\Department;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Department\StoreDeaprtmentRequest;
use App\Http\Requests\Dashboard\Department\UpdateDeaprtmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::select()->get();
        return view('dashboard.department.index',compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.department.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDeaprtmentRequest $request)
    {
        $data = $request->except('_token', 'name_ar', 'name_en');
        $data['name'] = $request->only('name_ar', 'name_en');

        $department = Department::create($data);

        if (!$department)
            return redirect()->route('departments.create')->with('error', 'Something went wrong, please try again.');

        return redirect()->route('departments.index')->with('success', 'The data has been saved successfully.');
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
        $department = Department::where('id',$id)->first();
        return view('dashboard.department.edit',compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDeaprtmentRequest $request, $id)
    {
        $data = $request->except('_token', 'name_ar', 'name_en','_method');
        $data['name'] = $request->only('name_ar', 'name_en');

        $department = Department::where('id',$id)->update($data);

        if (!$department)
            return redirect()->route('departments.edit',['department'=>$department->id])->with('error', 'Something went wrong, please try again.');

        return redirect()->route('departments.index')->with('success', 'The data has been saved successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = Department::find($id);

        if (!$department)
            return redirect()->route('departments.index')->with('error', __('website\includes\sessionDisplay.wrong'));

        $department->delete();
        return redirect()->route('departments.index')->with('success', 'Successfully deleted!');
    }
}

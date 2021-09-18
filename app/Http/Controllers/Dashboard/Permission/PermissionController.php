<?php

namespace App\Http\Controllers\Dashboard\Permission;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Permission\StorePermissionRequest;
use App\Http\Requests\Dashboard\Permission\UpdatePermissionRequest;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:deal_with_permissions_roles');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::select()->get();
        return view('dashboard.permission.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermissionRequest $request)
    {
        $validateOnExistence = Permission::where(['name' => $request->name, 'guard_name' => $request->provider])->first();

        if ($validateOnExistence)
            return redirect()->back()->with('error', 'Duplicated Entry.');

        $permission = Permission::create(['name' => $request->name, 'guard_name' => $request->provider]);

        if (!$permission)
            return redirect()->back()->with('error', __('website\includes\sessionDisplay.wrong'));

        return redirect()->route('permissions.index')->with('success', 'The data has been saved successfully');
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
        $permission = Permission::where('id',$id)->first();
        return view('dashboard.permission.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermissionRequest $request, $id)
    {
        $role = Permission::where('id',$id)->update(['name' => $request->name, 'guard_name' => $request->provider]);

        if (!$role)
            return redirect()->back()->with('error', __('website\includes\sessionDisplay.wrong'));

        return redirect()->route('permissions.index')->with('success', 'The data has been saved successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::find($id);

        if (!$permission)
            return redirect()->route('permissions.index')->with('error', __('website\includes\sessionDisplay.wrong'));

        $permission->delete();

        return redirect()->route('permissions.index')->with('success', 'Successfully deleted!');
    }
}

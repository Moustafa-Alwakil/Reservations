<?php

namespace App\Http\Controllers\Dashboard\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Role\StoreRoleRequest;
use App\Http\Requests\Dashboard\Role\UpdateRoleRequest;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
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
        $roles = Role::select()->get();
        return view('dashboard.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $validateOnExistence = Role::where(['name' => $request->name, 'guard_name' => $request->provider])->first();

        if ($validateOnExistence)
            return redirect()->back()->with('error', 'Duplicated Entry.');

        $role = Role::create(['name' => $request->name, 'guard_name' => $request->provider]);

        if (!$role)
            return redirect()->back()->with('error', __('website\includes\sessionDisplay.wrong'));

        return redirect()->route('roles.index')->with('success', 'The data has been saved successfully');
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
        $role = Role::where('id',$id)->first();
        return view('dashboard.role.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, $id)
    {
        $role = Role::where('id',$id)->update(['name' => $request->name, 'guard_name' => $request->provider]);

        if (!$role)
            return redirect()->back()->with('error', __('website\includes\sessionDisplay.wrong'));

        return redirect()->route('roles.index')->with('success', 'The data has been saved successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);

        if (!$role)
            return redirect()->route('roles.index')->with('error', __('website\includes\sessionDisplay.wrong'));

        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Successfully deleted!');
    }
}

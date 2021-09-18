<?php

namespace App\Http\Controllers\Dashboard\ModelPermission;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ModelPermission\StoreModelPermissionRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class ModelPermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:deal_with_permissions_roles');
    }

    public function index()
    {
        $modelPermissions =  DB::table('model_has_permissions')
            ->join('permissions', 'model_has_permissions.permission_id', '=', 'permissions.id')
            ->join('admins', 'model_has_permissions.model_id', '=', 'admins.id')
            ->select(
                'model_has_permissions.model_id',
                'admins.name',
                'admins.email',
                'permissions.name as permission_name',
                'model_has_permissions.permission_id',
            )
            ->where('model_type', 'App\Models\Admin')
            ->get();

        return view('dashboard.modelPermission.index', compact('modelPermissions'));
    }

    public function create()
    {
        $admins = Admin::select()->get();
        $permissions = Permission::select()->get();
        return view('dashboard.modelPermission.create', compact('permissions', 'admins'));
    }

    public function store(StoreModelPermissionRequest $request)
    {
        $admin = Admin::select()->where('id', $request->admin_id)->first();

        if (!$admin)
            return redirect()->back()->with('error', __('website\includes\sessionDisplay.wrong'));

        $admin->givePermissionTo($request->permission_name);

        return redirect()->route('modelspermissions.index')->with('success', 'The data has been saved successfully');
    }

    public function destroy($permission_id, $model_id)
    {
        $modelPermission = DB::table('model_has_permissions')->select()->where(['permission_id' => $permission_id, 'model_id' => $model_id, 'model_type' => 'App\Models\Admin'])->first();

        if (!$modelPermission)
            return redirect()->route('rolespermissions.index')->with('error', __('website\includes\sessionDisplay.wrong'));

        DB::table('model_has_permissions')->select()->where(['permission_id' => $permission_id, 'model_id' => $model_id, 'model_type' => 'App\Models\Admin'])->delete();

        return redirect()->route('modelspermissions.index')->with('success', 'Successfully deleted!');
    }
}

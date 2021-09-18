<?php

namespace App\Http\Controllers\Dashboard\RolePermission;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\RolePermission\StoreRolePermissionRequest;
use App\Http\Requests\Dashboard\RolePermission\UpdateRolePermissionRequest;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:deal_with_permissions_roles');
    }

    public function index()
    {
        $rolesPermissions =  DB::table('role_has_permissions')
            ->join('roles', 'role_has_permissions.role_id', '=', 'roles.id')
            ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            ->select(
                'role_has_permissions.role_id',
                'role_has_permissions.permission_id',
                'permissions.name as permission_name',
                'roles.name as role_name',
                'roles.guard_name as role_guard',
                'permissions.guard_name as permission_guard',
            )
            ->get();

        return view('dashboard.rolePermission.index', compact('rolesPermissions'));
    }

    public function create()
    {
        $roles = Role::select()->get();
        $permissions = Permission::select()->get();
        return view('dashboard.rolePermission.create', compact('roles', 'permissions'));
    }

    public function store(StoreRolePermissionRequest $request)
    {
        $validateOnExistence = DB::table('role_has_permissions')->where(['role_id' => $request->role_id, 'permission_id' => $request->permission_id])->first();

        if ($validateOnExistence)
            return redirect()->back()->with('error', 'Duplicated Entry.');

        $rolePermission = DB::table('role_has_permissions')->insert($request->except('_token'));

        if (!$rolePermission)
            return redirect()->back()->with('error', __('website\includes\sessionDisplay.wrong'));

        return redirect()->route('rolespermissions.index')->with('success', 'The data has been saved successfully');
    }

    public function edit($role_id, $permission_id)
    {
        $rolePermission =  DB::table('role_has_permissions')
            ->join('roles', 'role_has_permissions.role_id', '=', 'roles.id')
            ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            ->select(
                'role_has_permissions.role_id',
                'role_has_permissions.permission_id',
                'permissions.name as permission_name',
                'roles.name as role_name',
                'roles.guard_name as role_guard',
                'permissions.guard_name as permission_guard',
            )
            ->where(['role_id'=>$role_id, 'permission_id'=>$permission_id])
            ->first();

            $roles = Role::select()->get();
            $permissions = Permission::select()->get();

        return view('dashboard.rolePermission.edit', compact('rolePermission','roles','permissions'));
    }

    public function update(UpdateRolePermissionRequest $request, $role_id, $permission_id)
    {
        $rolePermission = DB::table('role_has_permissions')
              ->where(['role_id'=>$role_id, 'permission_id'=>$permission_id])
              ->update(['role_id'=>$request->role_id, 'permission_id'=>$request->permission_id]);

        if (!$rolePermission)
            return redirect()->back()->with('error', __('website\includes\sessionDisplay.wrong'));

        return redirect()->route('rolespermissions.index')->with('success', 'The data has been saved successfully');
    }

    public function destroy($role_id, $permission_id)
    {
        $rolePermission = DB::table('role_has_permissions')->select()->where(['role_id' => $role_id, 'permission_id' => $permission_id])->first();

        if (!$rolePermission)
            return redirect()->route('rolespermissions.index')->with('error', __('website\includes\sessionDisplay.wrong'));

        DB::table('role_has_permissions')->select()->where(['role_id' => $role_id, 'permission_id' => $permission_id])->delete();

        return redirect()->route('rolespermissions.index')->with('success', 'Successfully deleted!');
    }
}

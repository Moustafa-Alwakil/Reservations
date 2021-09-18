<?php

namespace App\Http\Controllers\Dashboard\ModelRole;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ModelRole\StoreModelRoleRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class ModelRoleController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('permission:deal_with_permissions_roles');
    }

    public function index()
    {
        $modelRoles =  DB::table('model_has_roles')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->join('admins', 'model_has_roles.model_id', '=', 'admins.id')
            ->select(
                'model_has_roles.model_id',
                'admins.name',
                'admins.email',
                'roles.name as role_name',
            )
            ->where('model_type', 'App\Models\Admin')
            ->get();

        return view('dashboard.modelRole.index', compact('modelRoles'));
    }

    public function create()
    {
        $admins = Admin::select()->get();
        $roles = Role::select()->get();
        return view('dashboard.modelRole.create', compact('roles', 'admins'));
    }

    public function store(StoreModelRoleRequest $request)
    {
        $admin = Admin::select()->where('id', $request->admin_id)->first();

        if (!$admin)
            return redirect()->back()->with('error', __('website\includes\sessionDisplay.wrong'));

        $admin->AssignRole($request->role_name);

        return redirect()->route('modelsroles.index')->with('success', 'The data has been saved successfully');
    }

    public function destroy($role_name, $model_id)
    {
        $admin = Admin::select()->where('id', $model_id)->first();

        if (!$admin)
            return redirect()->route('modelsroles.index')->with('error', __('website\includes\sessionDisplay.wrong'));

        $admin->removeRole($role_name);

        return redirect()->route('modelsroles.index')->with('success', 'Successfully deleted!');
    }
}

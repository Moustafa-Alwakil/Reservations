<?php

namespace App\Http\Controllers\Dashboard\RolePermission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolePermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $rolesPermissions =  DB::table('role_has_permissions')
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
        //
    }
}

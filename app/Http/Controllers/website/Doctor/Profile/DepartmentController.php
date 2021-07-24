<?php

namespace App\Http\Controllers\Website\Doctor\Profile;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        // $departments = Department::where('status', 1)->get();
        // if ($departments[0])
        //     return view('website.doctor.profile.department', compact('departments'));

        return view('website.doctor.profile.department');
    }
}

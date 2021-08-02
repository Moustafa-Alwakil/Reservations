<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use App\Models\Department;
use App\Models\Physican;
use App\Models\Review;

class IndexController extends Controller
{
    public function index()
    {
        return view('website.index');
    }

    public function allClinics()
    {
        $departments = Department::select()->where('status', 1)->get();
        $clinics = Clinic::select('id', 'name', 'physican_id')->where(['status' => 1, 'review' => 1])->with(['address' => function ($q) {
            $q->select('id', 'clinic_id', 'region_id')->with(['region' => function ($q) {
                $q->select()->where('status', 1);
            }, 'region.city' => function ($q) {
                $q->select()->where('status', 1);
            }]);
        }, 'clinicphotos', 'services' => function ($q) {
            $q->select()->where('status', 1);
        }, 'examfee', 'physican' => function ($q) {
            $q->select('id', 'name', 'department_id')->where('status', 1)->withCount('reviews')->with(['info' => function ($q) {
                $q->select('id', 'photo', 'physican_id');
            }, 'department','reviews'=>function($q){
                $q->select();
            }]);
        }])->paginate(10);
        return view('website.allClinics', compact('departments', 'clinics'));
    }

    public function clinic($id)
    {
        $clinic = Clinic::select('id', 'name', 'physican_id')->where(['status' => 1, 'review' => 1 , 'id' => $id])->with(['address' => function ($q) {
            $q->select()->with(['region' => function ($q) {
                $q->select()->where('status', 1);
            }, 'region.city' => function ($q) {
                $q->select()->where('status', 1);
            }]);
        }, 'clinicphotos', 'services' => function ($q) {
            $q->select()->where('status', 1);
        }, 'examfee', 'physican' => function ($q) {
            $q->select('id', 'name', 'department_id')->where('status', 1)->withCount('reviews')->with(['info' => function ($q) {
                $q->select('id', 'photo', 'about' ,'physican_id');
            }, 'department' , 'experiences'=>function($q){
                $q->select();
            } , 'reviews'=>function($q){
                $q->select();
            }]);
        },'workday'])->first();
        return view('website.clinic',compact('clinic'));
    }
}

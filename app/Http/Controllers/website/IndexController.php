<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\ClinicsFilterRequest;
use App\Http\Requests\Website\ShowClinicsByLocationRequest;
use App\Models\City;
use App\Models\Clinic;
use App\Models\ClinicService;
use App\Models\Department;
use App\Models\Region;
use App\Models\Review;
use Illuminate\Support\Facades\DB;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class IndexController extends Controller
{
    public function index()
    {
        $cities['data'] = City::select()->where('status', 1)->get();
        return view('website.index', compact('cities'));
    }

    public function getRegions($id)
    {

        $regions['data'] = Region::select('name', 'id')->where(['city_id' => $id, 'status' => 1])->get();

        return response()->json($regions);
    }

    public function clinicsFilter(ClinicsFilterRequest $request)
    {
        $departments = Department::select()->where('status', 1)->get();
        $clinics = DB::table('clinics')
            ->join('physicans', 'clinics.physican_id', '=', 'physicans.id')
            ->join('addresses', 'clinics.id', '=', 'addresses.clinic_id')
            ->join('regions', 'addresses.region_id', '=', 'regions.id')
            ->join('cities', 'regions.city_id', '=', 'cities.id')
            ->join('examfees', 'clinics.id', '=', 'examfees.clinic_id')
            ->join('departments', 'physicans.department_id', '=', 'departments.id')
            ->join('infos', 'physicans.id', '=', 'infos.physican_id')
            ->select(
                'clinics.id',
                'clinics.name',
                'clinics.phone',
                'physicans.id as doctor_id',
                'physicans.name as doctor_name',
                'regions.name as region_name',
                'cities.name as city_name',
                'examfees.price',
                'departments.name as department_name',
                'infos.photo as doctor_photo',
                'infos.title',
            )
            ->where([
                'clinics.status' => 1,
                'clinics.review' => 1,
                'physicans.status' => 1,
                'regions.status' => 1,
                'cities.status' => 1,
                'departments.status' => 1,
            ])
            ->where(
                function ($q) use ($request) {
                    if ($request->has('city_id'))
                        $q->where('cities.id', $request->city_id);
                }
            )
            ->where(
                function ($q) use ($request) {
                    if ($request->has('region_id'))
                        $q->where('regions.id', $request->region_id);
                }
            )
            ->where(
                function ($q) use ($request) {
                    if ($request->has('male') && !$request->has('female'))
                        $q->where('physicans.gender', $request->male);
                }
            )
            ->Where(
                function ($q) use ($request) {
                    if ($request->has('female') && !$request->has('male'))
                        $q->where('physicans.gender', $request->female);
                }
            )
            ->Where(
                function ($q) use ($request) {
                    if ($request->has('department_id')){
                        foreach ($request->department_id as $department_id) {
                            $q->orWhere('departments.id',$department_id);
                        }
                    }
                }
            )
            ->paginate(10)->withQueryString();
            
        $a = 0;
        $b = 0;
        $c = 0;

        $clinicPhotos=[];
        $clinicServices=[];
        $reviewsSum=[];
        $reviewsAvg=[];
        $reviewsCount=[];

        foreach ($clinics as $clinic) {
            $clinicPhotos[$a] = DB::table('clinicphotos')->select('photo')->where('clinic_id', $clinic->id)->get();
            $a++;
        }

        foreach ($clinics as $clinic) {
            $clinicServices[$b] = ClinicService::where('clinic_id', $clinic->id)->with(['service' => function ($q) {
                $q->where('status', 1);
            }])->get();
            $b++;
        }

        foreach ($clinics as $clinic) {
            $reviewsSum[$c] = Review::where('physican_id', $clinic->doctor_id)->sum('value');
            $reviewsAvg[$c] = round(Review::where('physican_id', $clinic->doctor_id)->avg('value'));
            $reviewsCount[$c] = Review::where('physican_id', $clinic->doctor_id)->count();
            $c++;
        }

        return view('website.allClinics', compact('departments', 'clinics', 'clinicPhotos', 'clinicServices', 'reviewsSum', 'reviewsCount', 'reviewsAvg'));
    }

    public function terms()
    {
        return view('website.terms');
    }

    public function policy()
    {
        return view('website.policy');
    }

    public function clinic($id)
    {
        $clinic = Clinic::select('id', 'name', 'phone', 'physican_id')->where(['status' => 1, 'review' => 1, 'id' => $id])->with(['address' => function ($q) {
            $q->select()->with(['region' => function ($q) {
                $q->select()->where('status', 1);
            }, 'region.city' => function ($q) {
                $q->select()->where('status', 1);
            }]);
        }, 'clinicphotos', 'services' => function ($q) {
            $q->select()->where('status', 1);
        }, 'examfee', 'physican' => function ($q) {
            $q->select('id', 'name', 'department_id')->where('status', 1)->withCount('reviews')->with(['certificates', 'info' => function ($q) {
                $q->select('id', 'photo', 'title', 'about', 'physican_id');
            }, 'department' => function ($q) {
                $q->select()->where('status', 1);
            }, 'experiences' => function ($q) {
                $q->select();
            }, 'reviews' => function ($q) {
                $q->select();
            }]);
        }, 'workday'])->first();

        if (!$clinic || !$clinic->address->region || !$clinic->address->region->city || !$clinic->physican || !$clinic->physican->department)
            return redirect()->back();

        return view('website.clinic', compact('clinic'));
    }
}

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

    public function allClinics()
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
            ->paginate(10);
        $a = 0;
        $b = 0;
        $c = 0;
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

    // public function showClinicsByLocation(ShowClinicsByLocationRequest $request)
    // {
    //     if (!$request->city_id && !$request->region_id) {
    //         $departments = Department::select()->where('status', 1)->get();
    //         $clinics = Clinic::select('id', 'name', 'phone', 'physican_id')->where(['status' => 1, 'review' => 1])->with(['address' => function ($q) {
    //             $q->select('id', 'clinic_id', 'region_id')->with(['region' => function ($q) {
    //                 $q->select()->where('status', 1);
    //             }, 'region.city' => function ($q) {
    //                 $q->select()->where('status', 1);
    //             }]);
    //         }, 'clinicphotos', 'services' => function ($q) {
    //             $q->select()->where('status', 1);
    //         }, 'examfee', 'physican' => function ($q) {
    //             $q->select('id', 'name', 'department_id')->where('status', 1)->withCount('reviews')->with(['info' => function ($q) {
    //                 $q->select('id', 'photo', 'physican_id');
    //             }, 'department' => function ($q) {
    //                 $q->select()->where('status', 1);
    //             }, 'reviews' => function ($q) {
    //                 $q->select();
    //             }]);
    //         }])->paginate(10);
    //         return view('website.allClinics', compact('departments', 'clinics'));
    //     }

    //     if ($request->has('city_id') && $request->has('region_id')) {
    //         $availableRegions = City::select('id')->where(['status' => 1, 'id' => $request->city_id])->with(['regions' => function ($q) {
    //             $q->select('id', 'city_id');
    //         }])->first();
    //         $i = 0;
    //         $available_regions_id = [];
    //         foreach ($availableRegions->regions as $region) {
    //             $available_regions_id[$i] = $region->id;
    //             $i++;
    //         }

    //         if (in_array($request->region_id, $available_regions_id)) {
    //             $departments = Department::select()->where('status', 1)->get();
    //             $clinicsByRegion = Region::where(['status' => 1, 'id' => $request->region_id])->with(['city' => function ($q) {
    //                 $q->select()->where('status', 1);
    //             }, 'addresses' => function ($q) {
    //                 $q->select()->with(['clinic' => function ($q) {
    //                     $q->select('id', 'name', 'phone', 'physican_id')->where(['status' => 1, 'review' => 1])->with(['clinicphotos', 'services' => function ($q) {
    //                         $q->select()->where('status', 1);
    //                     }, 'examfee', 'physican' => function ($q) {
    //                         $q->select('id', 'name', 'department_id');
    //                         $q->where('status', 1);
    //                         $q->withCount('reviews')->with(['info' => function ($q) {
    //                             $q->select('id', 'photo', 'physican_id');
    //                         }, 'department' => function ($q) {
    //                             $q->select()->where('status', 1);
    //                         }, 'reviews' => function ($q) {
    //                             $q->select();
    //                         }]);
    //                     }]);
    //                 }])->paginate(10);
    //             }])->first();
    //             return view('website.allClinics', compact('departments', 'clinicsByRegion'));
    //         } else {
    //             $departments = Department::select()->where('status', 1)->get();
    //             $clinics = Clinic::select('id', 'name', 'phone', 'physican_id')->where(['status' => 1, 'review' => 1])->with(['address' => function ($q) {
    //                 $q->select('id', 'clinic_id', 'region_id')->with(['region' => function ($q) {
    //                     $q->select()->where('status', 1);
    //                 }, 'region.city' => function ($q) {
    //                     $q->select()->where('status', 1);
    //                 }]);
    //             }, 'clinicphotos', 'services' => function ($q) {
    //                 $q->select()->where('status', 1);
    //             }, 'examfee', 'physican' => function ($q) {
    //                 $q->select('id', 'name', 'department_id')->where('status', 1)->withCount('reviews')->with(['info' => function ($q) {
    //                     $q->select('id', 'photo', 'physican_id');
    //                 }, 'department' => function ($q) {
    //                     $q->select()->where('status', 1);
    //                 }, 'reviews' => function ($q) {
    //                     $q->select();
    //                 }]);
    //             }])->paginate(10);
    //             return view('website.allClinics', compact('departments', 'clinics'));
    //         }
    //     }

    //     if ($request->has('city_id')) {
    //         $departments = Department::select()->where('status', 1)->get();
    //         $clinicsByCity = City::where(['status' => 1, 'id' => $request->city_id])->with(['regions' => function ($q) {
    //             $q->select()->where('status', 1)->with(['addresses' => function ($q) {
    //                 $q->select()->with(['clinic' => function ($q) {
    //                     $q->select('id', 'name', 'phone', 'physican_id')->where(['status' => 1, 'review' => 1])->with(['clinicphotos', 'services' => function ($q) {
    //                         $q->select()->where('status', 1);
    //                     }, 'examfee', 'physican' => function ($q) {
    //                         $q->select('id', 'name', 'department_id')->where('status', 1)->withCount('reviews')->with(['info' => function ($q) {
    //                             $q->select('id', 'photo', 'physican_id');
    //                         }, 'department' => function ($q) {
    //                             $q->select()->where('status', 1);
    //                         }, 'reviews' => function ($q) {
    //                             $q->select();
    //                         }]);
    //                     }]);
    //                 }])->paginate(10);
    //             }]);
    //         }])->first();
    //         return view('website.allClinics', compact('departments', 'clinicsByCity'));
    //     }

    //     if ($request->has('region_id')) {
    //         $departments = Department::select()->where('status', 1)->get();
    //         $clinicsByRegion = Region::where(['status' => 1, 'id' => $request->region_id])->with(['city' => function ($q) {
    //             $q->select()->where('status', 1);
    //         }, 'addresses' => function ($q) {
    //             $q->select()->with(['clinic' => function ($q) {
    //                 $q->select('id', 'name', 'phone', 'physican_id')->where(['status' => 1, 'review' => 1])->with(['clinicphotos', 'services' => function ($q) {
    //                     $q->select()->where('status', 1);
    //                 }, 'examfee', 'physican' => function ($q) {
    //                     $q->select('id', 'name', 'department_id')->where('status', 1)->withCount('reviews')->with(['info' => function ($q) {
    //                         $q->select('id', 'photo', 'physican_id');
    //                     }, 'department' => function ($q) {
    //                         $q->select()->where('status', 1);
    //                     }, 'reviews' => function ($q) {
    //                         $q->select();
    //                     }]);
    //                 }]);
    //             }])->paginate(10);
    //         }])->first();
    //         return view('website.allClinics', compact('departments', 'clinicsByRegion'));
    //     }
    // }

    public function showClinicsByLocation(ShowClinicsByLocationRequest $request)
    {

        if ($request->has('city_id') && $request->has('region_id')) {
            $availableRegions = City::select('id')->where(['status' => 1, 'id' => $request->city_id])->with(['regions' => function ($q) {
                $q->select('id', 'city_id');
            }])->first();
            $i = 0;
            $available_regions_id = [];
            foreach ($availableRegions->regions as $region) {
                $available_regions_id[$i] = $region->id;
                $i++;
            }
            if (!in_array($request->region_id, $available_regions_id)) {
                $departments = Department::select()->where('status', 1)->get();
                $clinics = Clinic::select('id', 'name', 'phone', 'physican_id')->where(['status' => 1, 'review' => 1])->with(['address' => function ($q) {
                    $q->select('id', 'clinic_id', 'region_id')->with(['region' => function ($q) {
                        $q->select()->where('status', 1);
                    }, 'region.city' => function ($q) {
                        $q->select()->where('status', 1);
                    }]);
                }, 'clinicphotos', 'services' => function ($q) {
                    $q->select()->where('status', 1);
                }, 'examfee', 'physican' => function ($q) {
                    $q->select('id', 'name', 'department_id')->where('status', 1)->withCount('reviews')->with(['info' => function ($q) {
                        $q->select('id', 'photo', 'title', 'physican_id');
                    }, 'department' => function ($q) {
                        $q->select()->where('status', 1);
                    }, 'reviews' => function ($q) {
                        $q->select();
                    }]);
                }])->paginate(10);
                return view('website.allClinics', compact('departments', 'clinics'));
            }
        }

        $departments = Department::select()->where('status', 1)->get();
        $clinicsByLocation = Clinic::select('id', 'name', 'phone', 'physican_id')->where(['status' => 1, 'review' => 1])->with(['address' => function ($q) use ($request) {
            $q->select('id', 'clinic_id', 'region_id')->with(['region' => function ($q) use ($request) {
                $q->select()->where('status', 1);
                if ($request->region_id) {
                    $q->where('id', $request->region_id);
                }
            }, 'region.city' => function ($q) use ($request) {
                $q->select()->where('status', 1);
                if ($request->city_id) {
                    $q->where('id', $request->city_id);
                }
            }]);
        }, 'clinicphotos', 'services' => function ($q) {
            $q->select()->where('status', 1);
        }, 'examfee', 'physican' => function ($q) {
            $q->select('id', 'name', 'department_id')->where('status', 1)->withCount('reviews')->with(['info' => function ($q) {
                $q->select('id', 'photo', 'title', 'physican_id');
            }, 'department' => function ($q) {
                $q->select()->where('status', 1);
            }, 'reviews' => function ($q) {
                $q->select();
            }]);
        }])->paginate(1);
        // $clinicsByLocation=[];
        // $i=0;
        // foreach ($clinics as $clinic){
        //     if (!$clinic->physican || !$clinic->address->region || !$clinic->address->region->city || !$clinic->physican->department) {
        //         continue;
        //     }
        //     $clinicsByLocation[$i]=$clinic;
        //     $i++;
        // }
        // return $clinicsByLocation->links();
        return view('website.allClinics', compact('departments', 'clinicsByLocation'));
    }

    public function clinicsFilter(ClinicsFilterRequest $request)
    {
        if (!$request->city_id && !$request->region_id && !$request->male && !$request->female && !$request->id) {
            $departments = Department::select()->where('status', 1)->get();
            $clinics = Clinic::select('id', 'name', 'phone', 'physican_id')->where(['status' => 1, 'review' => 1])->with(['address' => function ($q) {
                $q->select('id', 'clinic_id', 'region_id')->with(['region' => function ($q) {
                    $q->select()->where('status', 1);
                }, 'region.city' => function ($q) {
                    $q->select()->where('status', 1);
                }]);
            }, 'clinicphotos', 'services' => function ($q) {
                $q->select()->where('status', 1);
            }, 'examfee', 'physican' => function ($q) {
                $q->select('id', 'name', 'department_id')->where('status', 1)->withCount('reviews')->with(['info' => function ($q) {
                    $q->select('id', 'photo', 'title', 'physican_id');
                }, 'department' => function ($q) {
                    $q->select()->where('status', 1);
                }, 'reviews' => function ($q) {
                    $q->select();
                }]);
            }])->paginate(10);
            return view('website.allClinics', compact('departments', 'clinics'));
        }
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

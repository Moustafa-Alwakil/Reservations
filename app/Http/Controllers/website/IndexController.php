<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\ClinicsFilterRequest;
use App\Http\Requests\Website\ShowClinicsByLocationRequest;
use App\Models\City;
use App\Models\Clinic;
use App\Models\Department;
use App\Models\Physican;
use App\Models\Region;
use Illuminate\Support\Facades\DB;

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
                $q->select('id', 'photo', 'physican_id');
            }, 'department' => function ($q) {
                $q->select()->where('status', 1);
            }, 'reviews' => function ($q) {
                $q->select();
            }]);
        }])->paginate(10);
        return view('website.allClinics', compact('departments', 'clinics'));
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
                        $q->select('id', 'photo', 'physican_id');
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
                $q->select('id', 'photo', 'physican_id');
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
                    $q->select('id', 'photo', 'physican_id');
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
            $q->select('id', 'name', 'department_id')->where('status', 1)->withCount('reviews')->with(['info' => function ($q) {
                $q->select('id', 'photo', 'about', 'physican_id');
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

<?php

namespace App\Http\Requests\Website\Doctor\Clinic;

use App\Models\Service;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateClinicRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $services = Service::select('id')->where('department_id', Auth::guard('doc')->user()->department_id)->get();
        $i = 0;
        $available_services_id=[];
        foreach ($services as $service) {
            $available_services_id[$i] = $service->id;
            $i++;
        }
        return [
            // clinic basic info
            'name_ar' => 'required|string|min:4|max:25',
            'name_en' => 'required|string|min:4|max:25',
            'phone' => ['required', 'numeric', 'digits_between:7,15', Rule::unique('clinics')->ignore(session()->pull('clinic_id'))],
            'status' => ['required', Rule::in([0, 1])],
            'photo.*' => 'mimes:png,jpg,jpeg|max:4000|image',
            'license' => 'mimes:png,jpg,jpeg|max:4000|image',
            // clinic basic info

            ################################################################################################################################################################


            // clinic address
            'city' => 'required|exists:cities,id',
            'region_id' => 'required|exists:regions,id',
            'street_ar' => 'required|string|min:4|max:50',
            'street_en' => 'required|string|min:4|max:50',
            'building_ar' => 'required|string|max:30',
            'building_en' => 'required|string|max:30',
            'floor' => 'required|string|max:20',
            'apartno' => 'required|string|max:20',
            'landmark_ar' => 'required|string|min:5|max:80',
            'landmark_en' => 'required|string|min:5|max:80',
            // clinic address

            ################################################################################################################################################################


            // clinic workdays

            //saturday
            'sat_status' => ['required', Rule::in([0, 1])],
            'sat_start_time' => 'required_unless:sat_status,0|prohibited_unless:sat_status,1|nullable|date_format:H:i',
            'sat_end_time' => 'required_unless:sat_status,0|prohibited_unless:sat_status,1|nullable|date_format:H:i|after:sat_start_time',
            'sat_duration' => 'required_unless:sat_status,0|prohibited_unless:sat_status,1|nullable|integer|min:3',

            //sunday
            'sun_status' => ['required', Rule::in([0, 1])],
            'sun_start_time' => 'required_unless:sun_status,0|prohibited_unless:sun_status,1|nullable|date_format:H:i',
            'sun_end_time' => 'required_unless:sun_status,0|prohibited_unless:sun_status,1|nullable|date_format:H:i|after:sun_start_time',
            'sun_duration' => 'required_unless:sun_status,0|prohibited_unless:sun_status,1|nullable|integer|min:3',

            //monday
            'mon_status' => ['required', Rule::in([0, 1])],
            'mon_start_time' => 'required_unless:mon_status,0|prohibited_unless:mon_status,1|nullable|date_format:H:i',
            'mon_end_time' => 'required_unless:mon_status,0|prohibited_unless:mon_status,1|nullable|date_format:H:i|after:mon_start_time',
            'mon_duration' => 'required_unless:mon_status,0|prohibited_unless:mon_status,1|nullable|integer|min:3',

            //tuesday
            'tue_status' => ['required', Rule::in([0, 1])],
            'tue_start_time' => 'required_unless:tue_status,0|prohibited_unless:tue_status,1|nullable|date_format:H:i',
            'tue_end_time' => 'required_unless:tue_status,0|prohibited_unless:tue_status,1|nullable|date_format:H:i|after:tue_start_time',
            'tue_duration' => 'required_unless:tue_status,0|prohibited_unless:tue_status,1|nullable|integer|min:3',

            //wednesday
            'wed_status' => ['required', Rule::in([0, 1])],
            'wed_start_time' => 'required_unless:wed_status,0|prohibited_unless:wed_status,1|nullable|date_format:H:i',
            'wed_end_time' => 'required_unless:wed_status,0|prohibited_unless:wed_status,1|nullable|date_format:H:i|after:wed_start_time',
            'wed_duration' => 'required_unless:wed_status,0|prohibited_unless:wed_status,1|nullable|integer|min:3',

            //thursday
            'thu_status' => ['required', Rule::in([0, 1])],
            'thu_start_time' => 'required_unless:thu_status,0|prohibited_unless:thu_status,1|nullable|date_format:H:i',
            'thu_end_time' => 'required_unless:thu_status,0|prohibited_unless:thu_status,1|nullable|date_format:H:i|after:thu_start_time',
            'thu_duration' => 'required_unless:thu_status,0|prohibited_unless:thu_status,1|nullable|integer|min:3',

            //friday
            'fri_status' => ['required', Rule::in([0, 1])],
            'fri_start_time' => 'required_unless:fri_status,0|prohibited_unless:fri_status,1|nullable|date_format:H:i',
            'fri_end_time' => 'required_unless:fri_status,0|prohibited_unless:fri_status,1|nullable|date_format:H:i|after:fri_start_time',
            'fri_duration' => 'required_unless:fri_status,0|prohibited_unless:fri_status,1|nullable|integer|min:3',

            // clinic workdays

            ################################################################################################################################################################

            // clinic services
            'service_id' => ['required', 'exists:services,id'],
            'service_id.*' => [Rule::in($available_services_id)],
            //clinic services

            ################################################################################################################################################################

            // clinic price
            'price' => 'required|integer|min:1',
            //clinic price
        ];
    }
}

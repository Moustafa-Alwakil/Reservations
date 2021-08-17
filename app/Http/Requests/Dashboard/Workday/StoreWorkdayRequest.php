<?php

namespace App\Http\Requests\Dashboard\Workday;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreWorkdayRequest extends FormRequest
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
        return [

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

            'clinic_id'=>'required|exists:clinics,id',
            'doctor'=>'required|exists:physicans,id',
            
        ];
    }
}

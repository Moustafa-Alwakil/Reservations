<?php

namespace App\Http\Requests\Website\Doctor\Profile;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateExperienceRequest extends FormRequest
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
            'title_ar'=> 'required|string|min:5|max:30',
            'title_en'=> 'required|string|min:5|max:30',
            'place_en' => 'required|string|min:10|max:100',
            'place_ar' => 'required|string|min:10|max:100',
            'status'=> ['required', Rule::in([0,1])],
            'start_date' => ['required', 'date','after_or_equal:' . date_sub(date_create(Auth::guard('doc')->user()->birthdate), date_interval_create_from_date_string("-21 years"))->format('Y-m-d'),'before:now'],
            'end_date'=>'required_unless:status,1|prohibited_unless:status,0|nullable|date|after:start_date|before:tomorrow',
        ];
    }
    public function messages()
    {
        return [
            'start_date.after_or_equal' => 'The experience start date must be a date when you were at least 21 years old.',
            'end_date.required_unless' => 'The end date field is required unless your job status is current job.',
            'end_date.prohibited_unless' => 'The end date field must be empty unless your job status is current job.',
        ];
    }
}

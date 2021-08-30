<?php

namespace App\Http\Requests\Website\Doctor\Certificate;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreCertificateRequest extends FormRequest
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
            'university_ar'=>'required|string|min:5|max:70',
            'university_en'=>'required|string|min:5|max:70',
            'field_ar'=>'required|string|min:5|max:70',
            'field_en'=>'required|string|min:5|max:70',
            'start_date' => ['required', 'date','after_or_equal:' . date_sub(date_create(Auth::guard('doc')->user()->birthdate), date_interval_create_from_date_string("-14 years"))->format('Y-m-d'),'before:now'],
            'end_date'=>'required|date|after:start_date|before:tomorrow',
            'type'=> ['required', Rule::in([1,2,3,4])],
            'photo' => 'required|mimes:png,jpg,jpeg|max:4000|image',
        ];
    }
    public function messages()
    {
        return [
            'start_date.after_or_equal' => 'Invalid start date.',
        ];
    }
}

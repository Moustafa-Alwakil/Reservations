<?php

namespace App\Http\Requests\Website\Doctor\Clinic;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreClinicRequest extends FormRequest
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
            'name_ar' => 'required|string|max:25',
            'name_en' => 'required|string|max:25',
            'license' => 'required|mimes:png,jpg,jpeg|max:4000|image',
            'phone' => 'required|numeric|digits_between:7,15|unique:clinics',
            'status'=> ['required', Rule::in([0,1])],
        ];
    }
}

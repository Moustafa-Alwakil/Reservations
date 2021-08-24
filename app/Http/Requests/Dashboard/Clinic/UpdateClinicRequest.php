<?php

namespace App\Http\Requests\Dashboard\Clinic;

use Illuminate\Foundation\Http\FormRequest;
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
        return [
            'name_ar' => 'required|string|min:4|max:25',
            'name_en' => 'required|string|min:4|max:25',
            'phone' => ['required', 'numeric', 'digits_between:7,15', Rule::unique('clinics')->ignore(request()->route('clinic'))],
            'status' => ['required', Rule::in([0, 1])],
            'physican_id' => 'required|exists:physicans,id',
            'review' => ['required', Rule::in([0, 1, 2])],
            'license' => 'mimes:png,jpg,jpeg|max:4000|image',
        ];
    }
}

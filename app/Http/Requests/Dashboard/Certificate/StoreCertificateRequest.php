<?php

namespace App\Http\Requests\Dashboard\Certificate;

use Illuminate\Foundation\Http\FormRequest;
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
            'type'=> ['required', Rule::in([1,2,3,4])],
            'photo' => 'required|mimes:png,jpg,jpeg|max:4000|image',
            'physican_id' => 'required|exists:physicans,id',
            'university_ar'=>'required|string|min:5|max:70',
            'university_en'=>'required|string|min:5|max:70',
            'field_ar'=>'required|string|min:5|max:70',
            'field_en'=>'required|string|min:5|max:70',
            'start_date' => ['required', 'date','before:now'],
            'end_date'=>'required|date|after:start_date|before:tomorrow',
        ];
    }
}

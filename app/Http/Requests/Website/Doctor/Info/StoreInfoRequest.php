<?php

namespace App\Http\Requests\Website\Doctor\Info;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreInfoRequest extends FormRequest
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
            'title'=> ['required', Rule::in([1,2,3,4,5,6])],
            'department_id'=> 'required|exists:departments,id',
            'license' => 'required|mimes:png,jpg,jpeg|max:4000|image',
            'photo' => 'required|mimes:png,jpg,jpeg|max:4000|image',
            'about_en'=>'required|string|min:70|max:700',
            'about_ar'=>'required|string|min:70|max:700',
        ];
    }
}

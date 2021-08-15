<?php

namespace App\Http\Requests\Dashboard\Department;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDeaprtmentRequest extends FormRequest
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
            'name_ar'=>'required|string|max:50',
            'name_en'=>'required|string|max:50',
            'status'=> ['required', Rule::in([0,1])],
        ];
    }
}

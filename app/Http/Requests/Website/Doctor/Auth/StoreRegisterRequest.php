<?php

namespace App\Http\Requests\Website\Doctor\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;

class StoreRegisterRequest extends FormRequest
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
            'fname_ar' => 'required|string|max:25',
            'lname_ar' => 'required|string|max:25',
            'fname_en' => 'required|string|max:25',
            'lname_en' => 'required|string|max:25',
            'email' => 'required|string|email|max:50|unique:physicans',
            'gender' => ['required', Rule::in(['m', 'f']),],
            'birthdate' => ['required', 'date', 'after_or_equal:' . date_sub(now(), date_interval_create_from_date_string("80 years"))->format('Y-m-d'), 'before_or_equal:' . date_sub(now(), date_interval_create_from_date_string("22 years"))->format('Y-m-d')],
            'password' => ['required', 'confirmed', Rules\Password::defaults(), 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'],
        ];
    }
    public function messages()
    {
        return [
            'birthdate.before_or_equal' => __('validation.doc.birthdate.before_or_equal'),
            'birthdate.after_or_equal' => __('validation.doc.birthdate.after_or_equal'),
        ];
    }
}

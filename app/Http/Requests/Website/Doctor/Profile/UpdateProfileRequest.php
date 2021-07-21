<?php

namespace App\Http\Requests\Website\Doctor\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:50', Rule::unique('physicans')->ignore(Auth::guard('doc')->user()->id)],
            'gender' => ['required', Rule::in(['m', 'f']),],
            'birthdate' => ['required', 'date', 'after_or_equal:' . date_sub(now(), date_interval_create_from_date_string("80 years"))->format('Y-m-d'), 'before_or_equal:' . date_sub(now(), date_interval_create_from_date_string("26 years"))->format('Y-m-d')],
        ];
    }
    public function messages()
    {
        return [
            'fname_ar.required' => 'The first name field is required',
            'fname_en.required' => 'The first name field is required',
            'fname_ar.max' => 'The first name must not be greater than 25 characters.',
            'fname_en.max' => 'The first name must not be greater than 25 characters.',
            'fname_ar.string' => 'The first name must be a string.',
            'fname_en.string' => 'The first name must be a string.',
            'lname_ar.required' => 'The last name field is required',
            'lname_en.required' => 'The last name field is required',
            'lname_ar.max' => 'The last name must not be greater than 25 characters.',
            'lname_en.max' => 'The last name must not be greater than 25 characters.',
            'lname_ar.string' => 'The last name must be a string.',
            'lname_en.string' => 'The last name must be a string.',
            'birthdate.before_or_equal' => 'You must be at least 26 years old.',
            'birthdate.after_or_equal' => 'You must not be more than 80 years old.',
        ];
    }
}

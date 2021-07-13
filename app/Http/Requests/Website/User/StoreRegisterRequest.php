<?php

namespace App\Http\Requests\Website\User;

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
            'fname' => 'required|string|max:25',
            'lname' => 'required|string|max:25',
            'email' => 'required|string|email|max:50|unique:users',
            'phone' => 'required|numeric|digits_between:11,15|unique:users',
            'gender' => ['required', Rule::in(['m', 'f']),],
            'birthdate' => ['required', 'date', 'after_or_equal:' . date_sub(now(), date_interval_create_from_date_string("120 years"))->format('Y-m-d'), 'before_or_equal:' . date_sub(now(), date_interval_create_from_date_string("15 years"))->format('Y-m-d')],
            'password' => ['required', 'confirmed', Rules\Password::defaults(), 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'],
        ];
    }
    public function messages()
    {
        return [
            'fname.required' => 'The first name field is required',
            'fname.max' => 'The first name must not be greater than 25 characters.',
            'fname.string' => 'The first name must be a string.',
            'lname.required' => 'The last name field is required',
            'lname.max' => 'The last name must not be greater than 25 characters.',
            'lname.string' => 'The last name must be a string.',
            'birthdate.before_or_equal' => 'You must be at least 15 years old.',
        ];
    }
}

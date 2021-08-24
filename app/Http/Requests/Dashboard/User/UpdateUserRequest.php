<?php

namespace App\Http\Requests\Dashboard\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:50', Rule::unique('users')->ignore(request()->route('user'))],
            'phone' => ['required', 'numeric', 'digits_between:11,15', Rule::unique('users')->ignore(request()->route('user'))],
            'gender' => ['required', Rule::in(['m', 'f']),],
            'birthdate' => ['required', 'date', 'after_or_equal:' . date_sub(now(), date_interval_create_from_date_string("120 years"))->format('Y-m-d'), 'before_or_equal:' . date_sub(now(), date_interval_create_from_date_string("15 years"))->format('Y-m-d')],        ];
    }
    public function messages()
    {
        return [
            'birthdate.before_or_equal' => __('validation.birthdate.before_or_equal'),
            'birthdate.after_or_equal' => __('validation.birthdate.after_or_equal'),
        ];
    }
}

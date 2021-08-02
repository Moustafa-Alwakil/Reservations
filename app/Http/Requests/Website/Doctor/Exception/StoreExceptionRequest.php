<?php

namespace App\Http\Requests\Website\Doctor\Exception;

use Illuminate\Foundation\Http\FormRequest;

class StoreExceptionRequest extends FormRequest
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
            'date'=> 'required|after_or_equal:today|date_format:Y-m-d',
            'start_time'=> 'required|after:now|date_format:H:i',
            'end_time'=> 'required|after:start_time|date_format:H:i',
        ];
    }
}

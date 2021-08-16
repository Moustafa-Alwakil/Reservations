<?php

namespace App\Http\Requests\Dashboard\Exception;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExceptionRequest extends FormRequest
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
            'clinic_id'=>['required','exists:clinics,id'],
            'doctor' =>'required|exists:physicans,id',
            'date'=> 'required|after_or_equal:today|date_format:Y-m-d',
            'start_time'=> 'required|after:'.date('H:i').'|date_format:H:i',
            'end_time'=> 'required|after:start_time|date_format:H:i',
        ];
    }
}

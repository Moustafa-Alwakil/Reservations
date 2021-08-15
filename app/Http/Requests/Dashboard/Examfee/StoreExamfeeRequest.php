<?php

namespace App\Http\Requests\Dashboard\Examfee;

use Illuminate\Foundation\Http\FormRequest;

class StoreExamfeeRequest extends FormRequest
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
            'price'=>'required|integer',
            'doctor'=>'required|exists:physicans,id',
            'clinic_id'=>'required|exists:clinics,id',
        ];
    }
}

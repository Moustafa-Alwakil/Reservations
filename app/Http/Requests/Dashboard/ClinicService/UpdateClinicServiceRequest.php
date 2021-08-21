<?php

namespace App\Http\Requests\Dashboard\ClinicService;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClinicServiceRequest extends FormRequest
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
            'doctor'=>'required|exists:physicans,id',
            'clinic_id'=>'required|exists:clinics,id',
            'service_id'=>'required|exists:services,id',
        ];
    }
}

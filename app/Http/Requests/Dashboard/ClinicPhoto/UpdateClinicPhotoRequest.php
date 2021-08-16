<?php

namespace App\Http\Requests\Dashboard\ClinicPhoto;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClinicPhotoRequest extends FormRequest
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
            'photo' => 'nullable|mimes:png,jpg,jpeg|max:4000|image',
            'doctor' => 'required|exists:physicans,id',
            'clinic_id' => 'required|exists:clinics,id',
        ];
    }
}

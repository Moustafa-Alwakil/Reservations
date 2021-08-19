<?php

namespace App\Http\Requests\Dashboard\Address;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
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
            'city_id' => 'required|exists:cities,id',
            'region_id' => 'required|exists:regions,id',
            'clinic_id' => 'required|exists:clinics,id',
            'street_ar' => 'required|string|min:4|max:50',
            'street_en' => 'required|string|min:4|max:50',
            'building_ar' => 'required|string|max:30',
            'building_en' => 'required|string|max:30',
            'floor' => 'required|string|max:20',
            'apartno' => 'required|string|max:20',
            'landmark_ar' => 'required|string|min:5|max:80',
            'landmark_en' => 'required|string|min:5|max:80',
            'doctor' =>[ 'required','exists:physicans,id'],
        ];
    }
}

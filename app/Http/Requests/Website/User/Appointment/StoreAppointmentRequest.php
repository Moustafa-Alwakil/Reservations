<?php

namespace App\Http\Requests\Website\User\Appointment;

use App\Models\Clinic;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAppointmentRequest extends FormRequest
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
        $clinics = Clinic::select()->where(['review' => 1, 'status' => 1])->get();
        $i = 0;
        $available_clinics_id = [];
        foreach ($clinics as $clinic) {
            $available_clinics_id[$i] = $clinic->id;
            $i++;
        }
        return [
            'date' => 'required|date_format:Y-m-d',
            'bookdate' => 'required|after_or_equal:'.date('Y-m-d').'',
            'start_time'=> 'required|after:'.date('H:i').'|date_format:H:i',
            'end_time'=> 'required|after:start_time|date_format:H:i',
            'clinic_id' =>[ 'required',Rule::in($available_clinics_id),'exists:clinics,id'],
        ];
    }
}

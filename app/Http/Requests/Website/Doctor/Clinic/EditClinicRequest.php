<?php

namespace App\Http\Requests\Website\Doctor\Clinic;

use App\Models\Clinic;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EditClinicRequest extends FormRequest
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
        $clinics= Clinic::select('id')->where('physican_id',Auth::guard('doc')->user()->id)->get();
        $i=0;
        foreach ($clinics as $clinic) {
            $available_clinics_id[$i] = $clinic->id;
            $i++;
        }
        return [
            'id'=> ['required', Rule::in($available_clinics_id),'exists:clinics'],
        ];
    }
}

<?php

namespace App\Http\Requests\Website\Doctor\Exception;

use App\Models\Clinic;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
        $clinics= Clinic::select()->where(['physican_id'=>Auth::guard('doc')->user()->id])->get();
        $i=0;
        $available_clinics_id=[];
        foreach ($clinics as $clinic) {
            $available_clinics_id[$i] = $clinic->id;
            $i++;
        }
        return [
            'b'=>'required|integer',
            'clinic_id'=>['required','exists:clinics,id',Rule::in($available_clinics_id),'integer'],
            'date'=> 'required|after_or_equal:today|date_format:Y-m-d',
            'start_time'=> 'required|after:'.date('H:i').'|date_format:H:i',
            'end_time'=> 'required|after:start_time|date_format:H:i',
        ];
    }
}

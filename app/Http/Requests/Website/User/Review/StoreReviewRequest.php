<?php

namespace App\Http\Requests\Website\User\Review;

use App\Models\Physican;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreReviewRequest extends FormRequest
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
        $doctors = Physican::select('id')->where( 'status', 1)->get();
        $i = 0;
        foreach ($doctors as $doctor) {
            $available_doctors_id[$i] = $doctor->id;
            $i++;
        }
        return [
            'value' => 'required|min:1|max:5|integer',
            'physican_id' =>[ 'required',Rule::in($available_doctors_id),'exists:physicans,id'],
            'title' => 'required|max:70|string',
            'comment' => 'required|max:100|string',
            'accept' => ['required', Rule::in([1]),],
        ];
    }
}

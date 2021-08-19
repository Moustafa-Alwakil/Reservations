<?php

namespace App\Http\Requests\Dashboard\Review;

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
        return [
            'value' => 'required|min:1|max:5|integer',
            'physican_id' =>[ 'required','exists:physicans,id'],
            'user_id' =>[ 'required','exists:users,id'],
            'title' => 'required|max:70|string',
            'comment' => 'required|max:255|string',
        ];
    }
}

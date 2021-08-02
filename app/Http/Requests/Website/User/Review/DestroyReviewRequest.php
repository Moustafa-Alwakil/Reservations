<?php

namespace App\Http\Requests\Website\User\Review;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DestroyReviewRequest extends FormRequest
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
            'id'=>'required|exists:reviews',
            'user_id'=>['required', 'exists:users,id' ,Rule::in([Auth::guard('web')->user()->id]),],
        ];
    }
}

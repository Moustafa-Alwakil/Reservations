<?php

namespace App\Http\Requests\Dashboard\ModelRole;

use Illuminate\Foundation\Http\FormRequest;

class StoreModelRoleRequest extends FormRequest
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
            'admin_id'=> 'required|exists:admins,id',
            'role_name'=> 'required|exists:roles,name',
        ];
    }
}

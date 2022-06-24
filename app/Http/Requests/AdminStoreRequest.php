<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminStoreRequest extends FormRequest
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
            'name' => 'string|required',
            'phone' => ['numeric', 'required', 'regex:/^(([0][8])|([6][2][8])|([+][6][2][8]))[0-9]{8,12}$/'],
            'nik' => 'string|required',
            'occupation' => 'string|required',
            'email' => 'string|required|unique:users|email',
            'password' => 'string|required|alpha_num|min:8',
            'password_validation' => 'string|required|alpha_num|min:8|same:password',
        ];
    }
}

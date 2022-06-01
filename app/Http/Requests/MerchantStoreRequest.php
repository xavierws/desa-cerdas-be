<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MerchantStoreRequest extends FormRequest
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
            'address' => 'string|required',
            'city' => 'string|required',
            'province' => 'string|required',
            'postal_code' => 'numeric|required',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => 'string|required|unique|email',
            'password' => 'string|required|alpha_num|min:8',
            'password_validation' => 'string|required|alpha_num|min:8',
            'phone' => 'string|required|numeric|min:10|max:15'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
            'password_validation.required' => 'Validasi password wajib diisi',
            'email.unique' => 'email yang dimasukkan telah digunakan pada akun lain',
            'email.email' => 'email tidak sesuai',
            'password.alpha_num' => 'password harus terdiri dari minimal 8 karakter, terdapat huruf dan angka'
        ];
    }
}

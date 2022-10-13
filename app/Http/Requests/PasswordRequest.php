<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'actualUserPassword' => 'required',
            'newPassword' => 'required|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'actualUserPassword.required' => 'La contraseña actual es requerida',
            'newPassword.required' => 'La nueva contraseña es requerida',
            'newPassword.confirmed' => 'Las contraseñas no coinciden'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'address' => 'required',
            'phone' => 'required|numeric',
            'doc_id' => 'required|numeric',
            'roles' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'El :attribute es requerido',
            'name.required' => 'El nombre es requerido',
            'email.required' => 'El email es requerido',
            'password.required' => 'La contraseña es requerida',
            'password.same' => 'Contraseñas no concuerdan',
            'address.required' => 'La direccion es requerida',
            'doc_id.required' => 'El documento es requerido',
            'doc_id.numeric' => 'El documento debe ser un numero',
            'phone.required' => 'El telefono es requerido',
            'phone.numeric' => 'El telefono debe ser un numero'
        ];
    }
}

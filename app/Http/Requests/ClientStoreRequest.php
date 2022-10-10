<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientStoreRequest extends FormRequest
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
            'email' => 'required|unique:clients,email',
            'address' => 'required',
            'doc_id' => 'required|numeric',
            'phone' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'El :attribute es requerido',
            'name.required' => 'El nombre es requerido',
            'email.required' => 'El email es requerido',
            'email.unique' => 'El email ya existe',
            'address.required' => 'La direccion es requerida',
            'doc_id.required' => 'El documento es requerido',
            'doc_id.numeric' => 'El documento debe ser un numero',
            'phone.required' => 'El telefono es requerido',
            'phone.numeric' => 'El telefono debe ser un numero'
        ];
    }
}

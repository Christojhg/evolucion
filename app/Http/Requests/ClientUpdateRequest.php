<?php

namespace App\Http\Requests;

use App\Models\Client;
use App\Rules\RucValidation;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ClientUpdateRequest extends FormRequest
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
            'email' => 'required',
            'address' => 'required',
            'doc_id' => 'required|numeric',
            'doc_ruc' => ['nullable', 'numeric', 'unique:clients,doc_ruc,'.$this->client->id,new RucValidation],
            'phone' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'El :attribute es requerido',
            'name.required' => 'El nombre es requerido',
            'email.required' => 'El email es requerido',
            'address.required' => 'La direccion es requerida',
            'doc_id.required' => 'El documento es requerido',
            'doc_id.numeric' => 'El documento debe ser un numero',
            'doc_ruc.numeric' => 'El RUC debe ser un numero',
            'doc_ruc.unique' => 'El número RUC ya existe',
            'phone.required' => 'El telefono es requerido',
            'phone.numeric' => 'El telefono debe ser un numero'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'product' => 'required|exists:products,name',
            'cantidad' => 'required|min:1',
            'client_name' => 'required|exists:clients,name',
        ];
    }

    public function messages()
    {
        return [
            'product.required' => 'Se necesita un producto como minimo',
            'product.exists' => 'El producto no existe',
            'cantidad.required' => 'Se necesita una cantidad como minimo',
            'client_name.exists' => 'El cliente no existe',
            'client_name.required' => 'Se necesita agregar un cliente',
            'cantidad.min' => 'La cantidad minima debe ser 1'
        ];
    }
}

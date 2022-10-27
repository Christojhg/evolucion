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
            'cantidad' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'product.required' => 'Se necesita un producto como minimo',
            'cantidad.required' => 'Se necesita una cantidad como minimo',
            'exists' => 'El producto no existe, elija una correcto'
        ];
    }
}

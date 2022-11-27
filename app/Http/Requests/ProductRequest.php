<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'cod_prod' => ['required', 'unique:products,cod_prod'],
            'name' => ['required', 'unique:products,name'],
            'description' => 'required',
            'price' => ['required', 'numeric', 'min:0.5', 'max:100']
        ];
    }

    public function messages()
    {
        return [
            'required' => 'El :attribute es requerido',
            'cod_prod.required' => 'El código es requerido',
            'name.required' => 'El nombre es requerido',
            'description.required' => 'La descripción es requerida',
            'price.required' => 'El precio es requerido',
            'price.min' => 'El precio debe estar comprendido entre 0.5 y 100',
            'price.max' => 'El precio debe estar comprendido entre 0.5 y 100',
            'name.unique' => 'El nombre del producto ya existe',
            'cod_prod.unique' => 'El código del producto ya existe'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->count()) {
                if (!in_array($this->method(), ['PUT', 'PATCH'])) {
                    $validator->errors()->add('post', true);
                }
            }
        });
    }
}

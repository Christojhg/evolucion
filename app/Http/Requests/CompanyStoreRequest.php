<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyStoreRequest extends FormRequest
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
            'business_name' => 'required',
            'ruc' => 'required|numeric',
            'phone' => 'required|numeric',
            'movile' => 'required|numeric',
            'email' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'street' => 'required',
            'postal_code' => 'required',
            'entry' => 'required',
            'description' => 'required',
            'photo' => 'required|max:5000|mimes:jpeg,png,jpg'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'El :attribute es requerido',
            'name.required' => 'El nombre es requerido',
            'business_name.required' => 'El nombre de negocio es requerido',
            'ruc.required' => 'El RUC es requerido',
            'ruc.numeric' => 'El RUC debe ser un número',
            'phone.required' => 'El telefono es requerido',
            'phone.numeric' => 'El telefono debe ser un número',
            'movile.required' => 'El móbil es requerido',
            'movile.numeric' => 'El móbil debe ser un número',
            'email.required' => 'El email es requerido',
            'country.required' => 'El país es requerido',
            'state.required' => 'El estado es requerido',
            'city.required' => 'La ciudad es requerida',
            'street.required' => 'La calle es requerida',
            'postal_code.required' => 'El código postal es requerido',
            'entry.required' => 'El rubro es requerido',
            'description.required' => 'La descripción es requerida',
            'photo.required' => 'La foto es requerida',
            'photo.mimes' => 'Solo se acepta jpeg,png y jpg',
            'photo.max' => 'Solo se acepta máximo 5 MB'
        ];
    }
}

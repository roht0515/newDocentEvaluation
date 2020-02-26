<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormDiplomatRequest extends FormRequest
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
            //
            'name' => 'required',
            'version' => 'required|integer|min:1',
            'startDate' => 'required|date|after:yesterday',
        ];
    }
    public function messages()
    {
        return [
            //validar name
            'name.required' => 'El :attribute es obligatorio',
            //Validar version
            'version.required' => 'La :attribute es obligatorio',
            'version.integer' => 'La :attribute solo puede se numerica',
            'version.min' => 'La :attribute no puede ser negativa',
            //Validar Fecha
            'startDate.required' => 'La :attribute es obligatorio',
            'startDate.date' => 'La :attribute debe ser valida',
            'startDate.date' => 'La :attribute debe ser valida',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Nombre Diplomado',
            'version' => 'Version del Diplomado',
            'startDate' => 'Fecha de Inicio',
        ];
    }
}

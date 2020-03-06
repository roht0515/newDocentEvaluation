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
            'evaluation' => 'required|not_in:0',
            'startDate' => 'required|date||after_or_equal:yesterday',
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
            //evaluaciones
            'evaluation.required' => 'Seleccione una :attribute obligatoria',
            'evaluation.not_in' => 'Seleccione una :attribute valida',
            //Validar Fecha
            'startDate.required' => 'La :attribute es obligatorio',
            'startDate.date' => 'La :attribute debe ser valida',
            'startDate.after_or_equal' => 'La :attribute debe ser valida',

        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Nombre Diplomado',
            'version' => 'Version del Diplomado',
            'evaluation' => 'Evaluacion',
            'startDate' => 'Fecha de Inicio',
        ];
    }
}

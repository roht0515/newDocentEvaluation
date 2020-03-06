<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormDiplomatModuleRequest extends FormRequest
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
            'professor' => 'required|not_in:0',
            'name' => 'required',
            'number' => 'required|integer|min:1',
            'startDateEvaluation' => 'required|date|after_or_equal:yesterday',
            'endDateEvaluation' => 'required|date|after:startDateEvaluation',
            'startDateModule' => 'required|date|after_or_equal:yesterday',
            'endDateModule' => 'required|date|after:startDateModule',
            'group' => 'required',
            'classroom' => 'required',
        ];
    }
    public function messages()
    {
        return [
            //Docente
            'professor.required' => 'Selecccione un :attribute valido',
            'professor.not_in' => 'Seleccione un :attribute valido',
            //nombre del modulo
            'name.required' => 'Ingrese el :attribute ',
            //muero
            'number.required' => 'Ingrese el :attribute',
            //fecha de inicio de evaluacion
            'startDateEvaluation.required' => 'La :attribute es obligatoria',
            'startDateEvaluation.date' => 'Ingrese una :attribute valida',
            'startDateEvaluation.after_or_equal' => 'Seleccione una :attribute valida',
            //fecha final de evaluacion
            'endDateEvaluation.required' => 'La :attribute es obligatoria',
            'endDateEvaluation.date' => 'Ingrese una :attribute valida',
            'endDateEvaluation.after' => 'Seleccione una :attribute valida',
            //fecha de inicio modulo
            'startDateModule.required' => 'La :attribute es obligatoria',
            'startDateModule.date' => 'Ingrese una :attribute valida',
            'startDateModule.after_or_equal' => 'Seleccione una :attribute valida',
            //fecha final del modulo
            'endDateModule.required' => 'La :attribute es obligatoria',
            'endDateModule.date' => 'Ingrese :attribute valida',
            'endDateModule.after' => 'Seleccione una :attribute valida',
            //grupo
            'group.required' => 'Ingrese el nombre del :attribute',
            //Aula
            'classroom.required' => 'Ingrese la :attribute',
        ];
    }
    public function attributes()
    {
        return [
            'professor' => 'Docente',
            'name' => 'Nombre del Modulo',
            'number' => 'Numero de Modulo',
            'startDateEvaluation' => 'Fecha de Inicio de Evaluacion',
            'endDateEvaluation' => 'Fecha de Finalizacion de Evaluacion',
            'startDateModule' => 'Fecha de inicio de Modulo',
            'endDateModule' => 'Fecha de Finalizacion de Modulo',
            'group' => 'Grupo',
            'classroom' => 'Aula',
        ];
    }
}

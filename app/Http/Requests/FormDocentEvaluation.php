<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormDocentEvaluation extends FormRequest
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
            'ci' => 'required|unique:professor',
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'lastname' => 'required|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email|unique:professor',
            'phone' => 'required|integer|min:8',
            'address' => 'required',
            'startDate' => 'required|date|after:yesterday',
            'career' => 'required|regex:/^[\pL\s\-]+$/u',
            'turn' => 'required|not_in:0',
        ];
    }
    public function messages()
    {
        return [
            //validaciones de CI
            'ci.required' => 'La :attribute es obligatoria',
            'ci.unique' => ':attribute existente',
            //validaciones de Nombre
            'name.required' => 'El :attribute es obligatorio',
            'name.regex' => 'El :attribute no puede llevar valores numericos',
            //validaciones de apellido
            'lastname.required' => 'El :attribute es obligatorio',
            'lastname.regex' => 'El :attribute no puede llevar valores numericos',
            //Validaciones de correo
            'email.required' => 'El :attribute es obligatorio.',
            'email.email' => 'Ingrese un :attribute valido.',
            'email.unique' => 'Existe un docente con ese :attribute',
            //Validaciones de celular
            'phone.required' => 'El :attribute es obligatorio',
            'phone.integer' => 'El :attribute no es valido',
            'phone.min' => 'El :attribute debe tener minimo 8 digitos',
            //Validaciones de Direccion
            'address.required' => 'La :attribute es obligatorio',
            //validaciones de fecha
            'startDate.required' => 'La :attribute es obligatoria',
            'startDate.date' => 'Ingrese una :attribute valida',
            'startDate.after' => 'Seleccione una :attribute valida',
            //Validaciones de carrera
            'career.required' => 'El :attribute es obligatorio',
            'carrer.regex' => 'La :attribute solo puede llevar letras',
            //validaciones de turno
            'turn.required' => 'Seleccione un :attribute para el docente',
            'turn.not_in' => 'Selecionte un :attribute valido',

        ];
    }
    public function attributes()
    {
        return [
            'ci' => 'Cedula de Identidad',
            'name' => 'Nombre',
            'lastname' => 'Apellido',
            'email' => 'Correo Electronico',
            'phone' => 'Numero de Celular',
            'address' => 'Direccion de Domicilio',
            'startDate' => 'Fecha de Trabajo',
            'career' => 'Carrera Profesional',
            'turn' => 'Turno de Trabajo',
        ];
    }
}

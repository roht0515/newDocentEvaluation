<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormCertificateRequest extends FormRequest
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
            'ci' => 'required',
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'lastname' => 'required|regex:/^[\pL\s\-]+$/u',
            'career' => 'required|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email',
            'phone' => 'required|integer|min:8',
            'nameCertificate' => 'required',
            'reason' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'ci.required' => 'Ingrese la :attribute',
            'name.required' => 'Ingrese el :attribute del capacitado',
            'name.required' => 'Ingrese un :attribute valido',
            'lastname.required' => 'Ingrese el :attribute del capacitado',
            'lastname.required' => 'Ingrese un :attribute valido',
            'career.required' => 'Ingrese la :attribute del capacitado',
            'career.required' => 'Ingrese un :attribute valido',
            'email.required' => 'Ingrese un :attribute',
            'email.email' => 'Ingrese un :attribute valido',
            'phone.required' => 'El :attribute es obligatorio',
            'phone.min' => 'El :attribute debe tener minimo 8 digitos',
            'phone.integer' => 'El :attribute no es valido',
            'nameCertificate.required' => 'Ingrese el :attribute',
            'reason.required' => 'Ingrese la :attribute de entrega'
        ];
    }
    public function attributes()
    {
        return [
            'ci' => 'Cedula de Identidad',
            'name' => 'Nombre',
            'lastname' => 'Apellido',
            'career' => 'Carrera Profesional',
            'email' => 'Correo Electronico',
            'phone' => 'Numero de Celular',
            'nameCertificate' => 'Nombre del Certificado',
            'reason' => 'Razo',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormUserValidate extends FormRequest
{
    public function authorize()
    {
        //esto lo cambiamos a true para poder que nos dé permiso para acceder al request
        return true;
    }
    public function rules()
    {
        return [
            'username' => 'required|min:5|max:15|unique:users',
            'password' => 'required|min:5|max:15',
            'role' => 'required|not_in:0',
            'email' => 'required|email|unique:users',
        ];
    }
    public function messages()
    {
        return [
            //validaciones del username
            'username.required' => 'El :attribute es obligatorio.',
            'username.min' => 'El :attribute debe tener mas de 5 caracteres.',
            'username.max' => 'El :attribute debe tener menos de 15 caracteres.',
            'username.unique' => 'El :attribute ya existe',
            //validaciones del password
            'password.required' => 'El :attribute es obligatorio',
            'password.min' => 'La :attribute debe tener mas de 5 caracteres.',
            'password.max' => 'La :attribute debe tener menos de 15 caracteres.',
            //validaciones del rol
            'role.required' => 'Seleccione :attribute para el usuario',
            'role.not_in' => 'Seleccione un rol valido',
            //validaciones de email
            'email.required' => 'El :attribute es obligatorio.',
            'email.email' => 'Ingrese un :attribute valido.',
            'email.unique' => 'Existe un usuario con ese :attribute',

        ];
    }
    public function attributes()
    {
        return [
            'username'        => 'Nombre de Usuario',
            'password'        => 'Contraseña',
            'role'          => 'Rol de Usuario',
            'email'        => 'Correo Electronico',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormEvaluationRequest extends FormRequest
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
            'name' => 'required|min:5',
            'version' => 'required|integer|min:1',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Ingrese :attribute de la Evaluacion',
            'name.min' => 'Ingrese :attribute valido',
            'version.required' => 'Ingrese la :attribute de la Evaluacion',
            'version.integer' => 'Ingrese una :attribute valida',
            'version.min' => 'Ingrese una :attribute valida',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Nombre',
            'version' => 'Version',
        ];
    }
}

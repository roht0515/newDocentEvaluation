<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormQuestionRequest extends FormRequest
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
            'text' => 'required|min:5',
        ];
    }
    public function messages()
    {
        return [
            'text.required' => 'Ingrese :attribute de la pregunta',
            'text.min' => 'Ingrese :attribute valido',
        ];
    }
    public function attributes()
    {
        return [
            'text' => 'Texto',
        ];
    }
}

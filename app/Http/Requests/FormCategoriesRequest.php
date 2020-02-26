<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormCategoriesRequest extends FormRequest
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
            'name' => 'required|min:5',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Ingrese el :attribute de la categoria',
            'name.min' => 'Ingrese  un :attribute de categoria valida ',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Nombre',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuthorRequest extends FormRequest
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
            'name' => 'required|min:3|max:50',
            'last_name' => 'required|min:3|max:50',
            'year_of_birth' => 'required|date',
            'year_of_death' => 'nullable|date',
            'nationality' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'name' => '"Nombre"',
            'last_name' => '"Apellido"',
            'year_of_birth' => '"Año de nacimiento"',
            'year_of_death' => '"Año de defunción"',
            'nationality' => '"Nacionalidad"'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
            'name' => 'required|min:3',
            'description' => 'required|min:3',
            'number_of_pages' => 'required|integer',
            'year_of_publication' => 'required|date',
            'author_id' => 'required'
        ];
    }
    public function attributes()
    {
        return [
            'name' => '"Titulo"',
            'description' => '"Descripción"',
            'number_of_pages' => '"Numero de páginas"',
            'year_of_publication' => '"Año de publicacion"',
            'author_id' => '"Autor"'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCurso extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nombre' => 'required|min:4|max:30',  // dos validaciones
            'descripcion' => 'required|min:8',  // dos validaciones
            'categoria' => 'required'  // una validacion
        ];
    }

    public function attributes()
    {
        return [
            'nombre' => 'nombre del curso',
        ];
    }

    public function messages()
    {
        return [
            // Indicamos el campo a validar, luego punto para concatenar a la 
            // validacion em este caso tiene dos pero escogimos ala de required, 
            // y eso igualamos al mensaje que queremos que salga.
            'descripcion.required' => 'Debe ingresar una descripcion del curso',
        ];
    }
}


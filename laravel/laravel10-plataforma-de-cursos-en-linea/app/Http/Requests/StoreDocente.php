<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDocente extends FormRequest
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
            'nombres' => 'required|min:3',
            'apellidopaterno' => 'required|min:4',
            'apellidomaterno' => 'required|min:4',
            //'curso' => 'required|min:4',
            //'nivel' => 'required|min:7'
        ];
    }

    public function attributes()
    {
        return [
            //'nombres' => 'nombres del docente',
        ];
    }

    public function messages()
    {
        return [
            /* Indicamos el campo a validar, luego punto para concatenar a la validacion, em este caso tiene dos pero escogimos la de required, y eso igualamos al mensaje que queremos que salga.*/
            'nombres.required' => 'Debe ingresar sus nombres correctamente.',
            'apellidopaterno.required' => 'Debe ingresar sus apellidos correctamente.',
            'apellidomaterno.required' => 'Debe ingresar sus apellidos correctamente.',
            //'curso.required' => 'Debe ingresar un curso correctamente.',
            //'nivel.required' => 'Debe ingresar un nivel correcto (Inicial, Primaria o Secundaria).',
        ];
    }
}


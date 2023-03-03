<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            // 'name'=>'string|required|max:255',
            // 'dui'=>'string|required|unique:clients,dui,'.
            // $this->route('clients')->id.'|min:9|max:9',
            // 'address'=>'string|required|max:255',
            // 'phone'=>'string|required|unique:clients,phone,'.
            // $this->route('clients')->id.'|min:8|max:8',
            // 'email'=>'string|required|unique:clients,email,'.
            // $this->route('clients')->id.'|max:255|email:rfc,dns',
        ];
    }
    public function messages()
    {
        return[
            // 'name.required'=>'Este campo es requerido.',
            // 'name.string'=>'El valor no es correcto.',
            // 'name.max'=>'Solo se permite 50 caracteres.',

            // 'dui.string'=>'El valor no es correcto.',
            // 'dui.required'=>'Este campo es requerido.',
            // 'dui.mmin'=>'Se requiere 9 cacteres.',
            // 'dui.max'=>'Solo se permite 9 caracteres.',

            // 'address.required'=>'Este campo es requerido.',
            // 'address.string'=>'El valor no es correcto.',
            // 'address.max'=>'Solo se permite 255 caracteres.',

            // 'phone.string'=>'El valor no es correcto.',
            // 'phone.unique'=>'El número celular ya se encuentra registrado.',
            // 'phone.mmin'=>'Se requiere 8 cacteres.',
            // 'phone.max'=>'Solo se permite 8 caracteres.',

            // 'email.string'=>'El valor no es correcto.',
            // 'email.unique'=>'La dirección de correo electrónico ya se encuentra registrada.',
            // 'email.max'=>'Solo se permite 255 caracteres.',
            // 'email.email'=>'No es un correo electrónico.',
        ];
    }


}

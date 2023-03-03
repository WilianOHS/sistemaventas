<?php

namespace App\Http\Requests\Product;

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

            //'name'=>'string|required|unique:products,name,'.
            //$this->route('products')->id.'|max:255',
            "name" => 'required|unique:products,name,'.$this->route('product')->id.'|string',

            /*'price'=>'required|',
            'sale_price'=>'required|',
            'presentation'=>'required|string|max:50',
            'weight'=>'required|string|max:60',
            'year'=>'required|integer|max:4',
            'model'=>'required|string|max:255',*/
            'category_id'=>'integer|required|exists:App\Category,id',
            'provider_id'=>'integer|required|exists:App\Provider,id',

        ];
    }
    public function messages()
    {
        return[
            'name.required'=>'Este campo es requerido.',
            'name.string'=>'El valor no es correcto.',
            'name.unique'=>'El producto ya esta registrado',

            /*'price.required'=>'Este campo es requerido.',

            'sale_price.required'=>'Este campo es requerido.',

            'presentation.required'=>'Este campo es requerido.',
            'presentation.string'=>'El valor no es correcto.',
            'presentation.max'=>'Solo se permite 50 caracteres.',

            'weight.required'=>'Este campo es requerido.',
            'weight.string'=>'El valor no es correcto.',
            'weight.max'=>'Solo se permite 60 caracteres.',

            'year.required'=>'Este campo es requerido.',
            'year.integer'=>'El valor no es correcto.',
            'year.max'=>'Solo se permite 4 caracteres.',

            'model.required'=>'Este campo es requerido.',
            'model.string'=>'El valor no es correcto.',
            'model.max'=>'Solo se permite 255 caracteres.',*/

            'category_id.integer'=>'El valor tiene que ser entero',
            'category_id.required'=>'Este campo es requerido.',
            'category_id.exists'=>'La categoria no existe.',

            'provider_id.integer'=>'El valor tiene que ser entero',
            'provider_id.required'=>'Este campo es requerido.',
            'provider_id.exists'=>'El producto no existe.',
        ];
    }
}

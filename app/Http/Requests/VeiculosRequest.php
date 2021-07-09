<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VeiculosRequest extends FormRequest
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
            'tipo'=> 'required|string',
            'fabricante'=> 'required|string',
            'modelo'=> 'required|string',
            'ano'=> 'required|numeric',
            'placa'=> 'required|string',
            'renavam' => 'numeric|nullable',
            'km'=> 'required|string',
            'ativo'=> 'required|string',
            'img_url' => 'nullable|image|mimes:jpg,png,jpeg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
            'cep'=> 'required|string',
            'rua'=> 'required|string',
            'numero'=> 'required|string',
            'complemento'=> 'nullable|string',
            'bairro'=> 'required|string',
            'cidade'=> 'required|string',
            'estado'=> 'required|string',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UtilizacaoClienteRequest extends FormRequest
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

        if(Auth::user()->coordenador){
            return [
                "data" => "required|date",
                "motivo" => "required|string",
                "veiculo_id" => "required|numeric",
                "chkEnd" => "required|string",
                "cep" => "required_if:chkEnd,s|string",
                "rua" => "required_if:chkEnd,s|string",
                "numero" => "required_if:chkEnd,s|numeric",
                "complemento" => "nullable|string",
                "bairro" => "required_if:chkEnd,s|string",
                "cidade" => "required_if:chkEnd,s|string",
                "estado" => "required_if:chkEnd,s|string",
                "endereco" => "required_if:chkEnd,n|string|nullable",
                //"coordenador_email"=> "required|regex:/^.+@lasalle.+$/i",
            ]; 
        }
        return [
            "data" => "required|date",
            "motivo" => "required|string",
            "veiculo_id" => "required|numeric",
            "chkEnd" => "required|string",
            "cep" => "required_if:chkEnd,s|string",
            "rua" => "required_if:chkEnd,s|string",
            "numero" => "required_if:chkEnd,s|numeric",
            "complemento" => "nullable|string",
            "bairro" => "required_if:chkEnd,s|string",
            "cidade" => "required_if:chkEnd,s|string",
            "estado" => "required_if:chkEnd,s|string",
            "endereco" => "required_if:chkEnd,n|string|nullable",
            "coordenador_email"=> "required|regex:/^.+@lasalle.+$/i|exists:coordenadors,email",
            ]; 
    }
}

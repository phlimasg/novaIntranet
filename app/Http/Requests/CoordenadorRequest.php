<?php

namespace App\Http\Requests;

use App\Model\Coordenador;
use Illuminate\Foundation\Http\FormRequest;

class CoordenadorRequest extends FormRequest
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
        $coordenador = Coordenador::where('email',$this->email)->withTrashed()->first();
        if($coordenador){            
            $coordenador->deleted_at = null;
            $coordenador->save();
        }  
        
        return [
            'name' => 'required|string',
            'email' => 'required|string|regex:/^.+@lasalle.+$/i|unique:coordenadors,email'
        ];
    }
    public function messages()
    {
        return [
            'email.unique' => 'O coordenador já existe na base de dados e foi reativado, volte para a pagina anterior!',
        ];
    }
    
}

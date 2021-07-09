<?php

namespace App\Http\Requests;


use App\Model\Usuarios;
use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
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
        $usuario = Usuarios::where('email',$this->email)->withTrashed()->first();
        if($usuario){            
            $usuario->deleted_at = null;
            $usuario->save();
        }  
        
        return [
            'name' => 'required|string',
            'email' => 'required|string|regex:/^.+@lasalle.+$/i|unique:usuarios,email'
        ];
    }
    public function messages()
    {
        return [
            'email.unique' => 'O usuário já existe na base de dados e foi reativado, volte para a pagina anterior!',
        ];
    }
    
}

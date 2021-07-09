<?php

namespace App\Http\Requests;

use App\Model\Motorista;
use Illuminate\Foundation\Http\FormRequest;

class MotoristaRequest extends FormRequest
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
        $motorista = Motorista::where('email',$this->email)->withTrashed()->first();
        if($motorista){            
            $motorista->deleted_at = null;
            $motorista->save();
        }  
        
        return [
            'name' => 'required|string',
            'email' => 'required|string|regex:/^.+@lasalle.+$/i|unique:motoristas,email'
        ];
    }
    public function messages()
    {
        return [
            'email.unique' => 'O motorista já existe na base de dados e foi reativado, volte para a pagina anterior!',
        ];
    }
}

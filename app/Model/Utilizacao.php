<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Utilizacao extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'motivo',
        'dt_entrega',
        'dt_hora_saida',
        'dt_hora_retorno',
        'km_inicial',
        'km_final',
        'km_percorrido',
        'km_estimado',
        'tempo_estimado',
        'cep',
        'rua',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'endereco',
        'coordenador_email',
        'status',
        'token',
        'motorista_id',
        'veiculo_id',        
        'user_id',
    ];
    public function getUser()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function veiculo()
    {
        return $this->hasOne(Veiculo::class,'id','veiculo_id');
    }
    
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Veiculo extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'tipo',
        'fabricante',
        'modelo',
        'ano',
        'placa',
        'renavam',
        'km',
        'ativo',
        'img_url',
        'cep',
        'rua',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
    ];
}

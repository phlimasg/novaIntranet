<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $fillable = [
        'nome',
        'descricao',        
    ];
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuarios extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'email',
        'profile_picture'
    ];
}

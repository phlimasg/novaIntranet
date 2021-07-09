<?php

namespace App;

use App\Model\Coordenador;
use App\Model\Motorista;
use App\Model\Usuarios;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','profile_picture','token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function coordenador()
    {
        return $this->hasOne(Coordenador::class,'email','email');
    }
    public function motorista()
    {
        return $this->hasOne(Motorista::class,'email','email');
    }
    public function administrador()
    {
        return $this->hasOne(Usuarios::class,'email','email');
    }
}

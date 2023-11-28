<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class Usuario extends Authenticatable
{
    protected $table='usuarios';
    protected $fillable=['nome','email','password','perfil_id'];

    public function perfil()
    {
        return $this->belongsTo('App\Models\Perfil','perfil_id','id','');
    }
}

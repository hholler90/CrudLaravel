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

    public function temPermissao($permissao){
       
        return $this -> perfil -> permissoes -> contains('nome',$permissao);
    }
    
    public function loginLogs()
    {
        return $this->hasMany(LoginLog::class);
    }

    public function acaoLogs()
    {
        return $this->hasMany(AcaoLog::class);
    }
}

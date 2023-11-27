<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table='perfis';
    protected $fillable=['nomeperfil'];

    public function usuarios(){
        return $this->hasMany('App\Models\Usuario','perfil_id','id');
    }
}

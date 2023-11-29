<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{

    const PERFIL_USUARIO=3;

    protected $table='perfis';
    protected $fillable=['nome'];

    public function usuarios()
    {
        return $this->hasMany('App\Models\Usuario','perfil_id','id');
    }

    public function permissoes()
    {
        return $this->belongsToMany(Permissao::class, 'perfil_permissao');
    }
}

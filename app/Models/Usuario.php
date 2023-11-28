<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table='usuarios';
    protected $fillable=['nome','email','password','perfil_id'];

    public function perfil()
    {
        return $this->belongsTo('App\Models\Perfil','perfil_id','id','');
    }
}

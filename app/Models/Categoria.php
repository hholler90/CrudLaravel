<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table='categorias';
    protected $fillable = ['nome'];
    
    public function produto()
    {
        return $this->belongsTo('App\Models\Produto','categoria_id','id','');
    }
}

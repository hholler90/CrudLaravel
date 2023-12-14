<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Compra extends Model
{
    protected $table = 'compras';
    protected $fillable = ['usuario_id', 'datahora', 'valor_total'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function compraProdutos()
    {
        return $this->hasMany(CompraProduto::class, 'compra_id');
    }

    public function registrar($valorTotal)
    {
        $this->datahora = time();
        $this->usuario_id = Auth::user()->id;
        $this->valor_total = $valorTotal;
        $this->save();

        return $this;
    }

    public function getDataHoraFormatadaAttribute()
    {
        return $this->attributes['datahora']->format('d/m/Y H:i');
    }
}

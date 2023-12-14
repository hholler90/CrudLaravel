<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
class CompraProduto extends Model
{
    protected $appends = ['data_hora_formatada'];
    protected $table = 'compra_produtos';
    protected $fillable = ['usuario_id', 'produto_id','compra_id','valor_un','valor_total','quandidade'];

    public function __construct()
    {
    }

    public function user()
    {
        return $this->belongsTo(Usuario::class);
    }
    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
    public function compra()
    {
        return $this->belongsTo(Compra::class);
    }


    //public function registrar($produtoId, $compraId, $valorUn, $valorTotal, $quantidade)

    public function registrar($compraId,$produtoCarrinho)
    { 
    $this->datahora = time();
    $this->usuario_id = Auth::user()->id;
    $this->produto_id = $produtoCarrinho['produto_id'];
    $this->compra_id = $compraId;
    $this->valor_un = $produtoCarrinho['valor_un'];
    $this->valor_total = $produtoCarrinho['valor_total'];
    $this->quantidade = $produtoCarrinho['quantidade'];

    $this->save();
}

    public function getDataHoraFormatadaAttribute()
    {
        return date('d/m/Y H:i', $this->datahora);
    }
}

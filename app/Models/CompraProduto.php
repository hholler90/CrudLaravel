<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompraProduto extends Model
{
    protected $table='produto';
    protected $fillable = ['nome','preco'];
    
    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}

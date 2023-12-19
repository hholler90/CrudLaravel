<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AcaoLog extends Model
{
    protected $appends = ['data_hora_formatada'];
    protected $table='acoes_logs';
    protected $fillable = ['usuario_id', 'acao','tela','datahora'];

    public function __construct($tela=null)
    {
        
    $this->usuario_id=Auth::user()->id;
    $this->tela=$tela;
    
    }
    public function user()
    {
        return $this->belongsTo(Usuario::class);
    }
    public function registrar($acao)
    { 
        $this->datahora = time();
        $this->usuario_id = Auth::user()->id;
        $this->acao = $acao;
        $this->save();
    }
    public function getDataHoraFormatadaAttribute()
    {
        return date('d/m/Y H:i', $this->datahora);
    }
}
    



<?php

// app/Models/LoginLog.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LoginLog extends Model
{
    protected $appends = ['data_hora_formatada'];
    protected $table = 'login_logs';
    protected $fillable = ['usuario_id', 'acao','datahora'];

    public function __construct()
    {
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table='produtos';
    protected $fillable=['nome','preco','quantidade'];

    public function loginLogs()
    {
        return $this->hasMany(LoginLog::class);
    }

    public function acaoLogs()
    {
        return $this->hasMany(AcaoLog::class);
    }
}

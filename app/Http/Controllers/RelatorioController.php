<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoginLog;
use App\Models\AcaoLog;
use App\Models\CompraProduto;
use Auth;

class RelatorioController extends Controller
{
    
    public function logsLogin()
    {
        $loginLogs = LoginLog::all();
        return view('log.login', compact('loginLogs'));
    }

    public function logsAcao()
    {
        $acaoLog = AcaoLog::all();
        return view('log.acao', compact('acaoLog'));
    }

    public function logsCompra()
    {
        $compraProduto = CompraProduto::all();
        return view('log.compra', compact('compraProduto'));
    }
}


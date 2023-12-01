<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoginLog;
use App\Models\AcaoLog;
use Auth;

class RelatorioController extends Controller
{
    
    public function exibirLogs()
    {
        $loginLogs = LoginLog::all();
        $acaoLog = AcaoLog::all();

        return view('log.index', compact('loginLogs', 'acaoLog'));
    }
}

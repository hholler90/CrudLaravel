<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Usuario;
use App\Models\Perfil;
use Validator;
use App\Models\AcaoLog;

class CadastroController extends Controller
{

    private $log;
    public function __construct()
    {
        $this->log=new AcaoLog('Cadastro');
    }
    public function index()
    {
        return view('auth.register');
    }

    public function formulario(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    public function salvar(Request $request)
    {   
        $this->formulario($request->all());

        $user = Usuario::create([
            'nome' => $request['nome'],
            'email' => $request['email'],
            'password' => bcrypt(trim($request['password'])),
            'perfil_id' => Perfil::PERFIL_USUARIO
        ]);
        $this->log->registrar('Cadastro');
        Auth::login($user);
    
        return redirect('/login');
    }
}

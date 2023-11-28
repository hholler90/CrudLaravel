<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Perfil;
use App\Providers\EventServiceProvider;
use Illuminate\Foundation\Auth\User;

class UsuarioController extends Controller
{
  
    public function __construct()
    {
        
    }

    public function index()
    {
        return view('usuario.index')->with([
            'usuarios' => Usuario::all(),
            'perfis' => Perfil::lists('nome', 'id'),
            'formulario' =>new Usuario()

        ]);

       
    }
    public function formulario($id)
    {
        return view('usuario.formulario')->with(['formulario' =>Usuario::find($id),'perfis' => Perfil::lists('nome', 'id'),]);
        return redirect()->route('usuarios.index');
    }

    public function salvar(Request $request)
    {
       
        $req=$request->all();
        unset( $req['_token'] );
        $req['nome'] = trim($request->nome);
        $req['email'] = trim($request->email);
        $req['password'] =bcrypt(trim($request->password));
        if(empty($req['id'])){
            Usuario::create($req); 
        }
        else{
           Usuario::whereId( $req['id'] )->update($req); 
        } 
        return redirect()->route('usuarios.index');
    }

    public function deletar($id)
    {
        Usuario::where("id", "=", $id)->delete();
        return redirect()->route('usuarios.index');
    }
}

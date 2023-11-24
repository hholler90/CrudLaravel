<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Perfil;
use App\Providers\EventServiceProvider;
use Illuminate\Foundation\Auth\User;

class UsuarioController extends Controller
{

    private $objPerfil;
    private $objUsuario;

    public function __construct()
    {
        $this->objPerfil = new Perfil();
        $this->objUsuario = new Usuario();
    }

    public function index()
    {
        return view('usuario.index')->with([
            'usuarios' => $this->objPerfil->find(1)->usuarios,
            'perfis' => Perfil::lists('nomeperfil', 'id'),
            'formulario' =>new Usuario()

        ]);

        // dd($this->objUsuario->find(1)->load('perfil'));
        // dd(Usuario::with('perfil')->find(1));
        // dd($this->objUsuario->find(1)->perfil());
        // dd($this->objPerfil->find(1)->usuarios());
    }
    public function formulario($id)
    {
        return view('usuario.formulario')->with(['formulario' =>Usuario::find($id),'perfis' => Perfil::lists('nomeperfil', 'id'),]);
        return redirect()->route('usuarios.index');
    }

    public function salvar(Request $request)
    {
        // $this->objUsuario->create([
        //     'name' => trim($request->name),
        //     'email' => trim($request->email),
        //     'perfil_id' => $request->perfil_id,
        //     'password' => $request->password
        // ]);
        $req=$request->all();
        unset( $req['_token'] );
        $req['name'] = trim($request->name);
        $req['email'] = trim($request->email);
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

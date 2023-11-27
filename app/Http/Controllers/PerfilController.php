<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Permissao;
use Illuminate\Http\Request;

class PerfilController extends Controller
{

    private $objPerfil;
    private $objPermissao;
    
    public function __construct()
    {
        $this->objPerfil = new Perfil();
        $this->objPermissao = new Permissao();
        
    }

    public function index()
    {
        return view('perfil.index')->with([
            'perfis' => $this->objPerfil->all(),
            'permissoes' => Permissao::lists('nomepermissoes', 'id'),
            'formulario' =>new Perfil()
        ]);

        // dd($this->objUsuario->find(1)->load('perfil'));
        // dd(Usuario::with('perfil')->find(1));
        // dd($this->objUsuario->find(1)->perfil());
        // dd($this->objPerfil->find(1)->usuarios());
    }
    public function formulario($id)
    {
        return view('perfil.formulario')->with(['formulario' =>Perfil::find($id)]);
        
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
        $req['nome'] = trim($request->nome);
        $req['nomepermissoes'] = trim($request->nomepermissoes);
        if(empty($req['id'])){
            Perfil::create($req); 
        }
        else{
            Perfil::whereId( $req['id'] )->update($req); 
        } 
        return redirect('/perfis');
    }

    public function deletar($id)
    {
        Perfil::where("id", "=", $id)->delete();
        return redirect('/perfis');
    }
}

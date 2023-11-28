<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Permissao;
use Illuminate\Http\Request;

class PerfilController extends Controller
{

    public function __construct()
    {
        
    }

    public function index()
    {
        $permissoes = Permissao::lists('nome', 'id');
        return view('perfil.index')->with([
            'perfis' => Perfil::all(),
            'permissoes' => $permissoes,
            'formulario' => new Perfil()
        ]);

    }
    public function formulario($id)
    {
        $permissoes = Permissao::lists('nome', 'id');
        return view('perfil.formulario')->with([
            'formulario' => Perfil::find($id),
            'permissoes' => $permissoes
        ]);
    }

    public function salvar(Request $request)
    {
        $req = $request->all();
        unset($req['_token']);
        unset($req['permissoes']);
        $req['nome'] = trim($request->nome);
        if (empty($req['id'])) {
            $perfil= Perfil::create($req);
        } else {
            $perfil = Perfil::find($req['id']);
            Perfil::whereId($req['id'])->update($req);
        }
        $perfil->permissoes()->detach();
        if ($request->has('permissoes')) {
            $perfil->permissoes()->sync($request->permissoes);
        }
        return redirect('/perfis');
    }

    public function deletar($id)
    {
        Perfil::where("id", "=", $id)->delete();
        return redirect('/perfis');
    }
}

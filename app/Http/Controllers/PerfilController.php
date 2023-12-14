<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Permissao;
use Illuminate\Http\Request;
use App\Models\AcaoLog;
use Auth;
class PerfilController extends Controller
{
    private $log;
    public function __construct()
    {
        $this->log=new AcaoLog('Perfil');
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
        $acao='Criar';
        if (empty($req['id'])) {
            $perfil= Perfil::create($req);
        } else {
            $acao='Editar';
            $perfil = Perfil::find($req['id']);
            Perfil::whereId($req['id'])->update($req);
        }
        $perfil->permissoes()->detach();
        if ($request->has('permissoes')) {
            $perfil->permissoes()->sync($request->permissoes);
        }
        $this->log->registrar($acao);
        return redirect('/perfis');
    }

    public function deletar($id)
    {
        if(!Auth::user()->temPermissao('del')){
            abort(503);
        }
        $this->log->registrar('Delete');
        Perfil::where("id", "=", $id)->delete();
        return redirect('/perfis');
    }
}

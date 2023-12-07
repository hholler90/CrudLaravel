<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\AcaoLog;
use Auth;
class CategoriaController extends Controller
{
    private $log;
    public function __construct()
    {
        $this->log=new AcaoLog('Categoria');
    }

    public function index()
    {        
        return view('categoria.index')->with([
            'categorias' => Categoria::all(),
            'formulario' => new Categoria()
        ]);

    }
    public function formulario($id)
    {
        return view('categoria.index')->with([
            'formulario' => Categoria::find($id),   
        ]);
    }

    public function salvar(Request $request)
    {
        $req = $request->all();
        unset($req['_token']);
        unset($req['permissoes']);
        $req['nome'] = trim($request->nome);
        $acao='criar';
        if (empty($req['id'])) {
            Categoria::create($req);
        } else {
            $acao='Editar';
            Categoria::find($req['id']);
            Categoria::whereId($req['id'])->update($req);
        }
       
        $this->log->registrar($acao);
        return redirect('/categorias');
    }

    public function deletar($id)
    {
        if(!Auth::user()->temPermissao('del')){
            abort(503);
        }
        $this->log->registrar('Delete');
        Categoria::where("id", "=", $id)->delete();
        return redirect('/categorias');
    }
}
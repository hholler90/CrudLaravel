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
        $this->log = new AcaoLog('Categoria');
    }

    public function index()
    {
        $categorias = Categoria::all();

        return view('categoria.index')->with([
            'categorias' => $categorias,
            'formulario' => new Categoria()
        ]);
    }
    public function formulario($id = null)
    {
        $ultimasCategorias = Categoria::latest()->take(5)->get();
        $categoria = (object)[ 
            'id' =>$id,
            'categoria' => (empty($id))
                ? [''] : Categoria::where('id','=',$id)->lists('nome')->toArray()
        ];
      
        return view('categoria.formulario')->with([
            'formulario' => $categoria,
            'ultimasCategorias' => $ultimasCategorias,
            'id' => $id,
        ]);
    }


    public function salvar(Request $request)
    {
        $req = $request->all();
        $acao = 'Criar';
        if (empty($req['id'])) {
            // foreach($request->categoria as $categoria){
            //     Categoria::create(['nome'=>$categoria]);
            // }            
            // collect($request->categoria)->map(function($categoria){
            //     Categoria::create(['nome'=>$categoria]);
            // });
            $categorias=collect($request->categoria)->map(function($categoria){
                return ['nome'=>trim($categoria)];
            })->toArray();
            Categoria::insert($categorias);
        } else {
            $acao = 'Editar';
            Categoria::find($req['id']);
            Categoria::whereId($req['id'])->update(['nome' => $req['categoria'][0]]);
        }

        $this->log->registrar($acao);
        return redirect('/categorias');
    }

    public function deletar($id)
    {
        if (!Auth::user()->temPermissao('del')) {
            abort(503);
        }
        $this->log->registrar('Delete');
        Categoria::where("id", "=", $id)->delete();
        return redirect('/categorias');
    }
}

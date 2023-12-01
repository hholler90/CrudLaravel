<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Providers\EventServiceProvider;
use Auth;

class ProdutoController extends Controller
{

    private $objProduto;
    
    public function __construct()
    {
        $this->objProduto = new Produto();
        
    }

    public function index()
    {
        return view('produto.index')->with([
            'produtos' => $this->objProduto->all(),
            'formulario' =>new Produto()
        ]);
    }
    public function formulario($id)
    {
        return view('produto.formulario')->with(['formulario' =>Produto::find($id)]);
        
    }

    public function salvar(Request $request)
    {
        $req=$request->all();
        unset( $req['_token'] );
        $req['nome'] = trim($request->nome);
        $req['preco'] = trim($request->preco);
        $req['quantidade'] = trim($request->quantidade);
        if(empty($req['id'])){
            Produto::create($req); 
        }
        else{
            Produto::whereId( $req['id'] )->update($req); 
        } 
        return redirect('/produtos');
    }

    public function deletar($id)
    {
        if(!Auth::user()->temPermissao('del')){
            abort(503);
        }
        Produto::where("id", "=", $id)->delete();
        return redirect('/produtos');
    }
}

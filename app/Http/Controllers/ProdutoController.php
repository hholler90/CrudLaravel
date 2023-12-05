<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\AcaoLog;

use Auth;

class ProdutoController extends Controller
{
    private $log;
    private $objProduto;
    
    public function __construct()
    {
        $this->objProduto = new Produto();
        $this->log=new AcaoLog('Produto');
        
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
        copy( $request->upload->getRealPath(), public_path('imagens/') .  $request->upload->getClientOriginalName() );
        $req=$request->all();
        unset( $req['_token'] );
        unset( $req['upload'] );
        $req['nome'] = trim($request->nome);
        $req['preco'] = trim($request->preco);
        $req['quantidade'] = trim($request->quantidade);
        $req['imagem'] ='/imagens/' .  $request->upload->getClientOriginalName();
        $acao='criar';
        if(empty($req['id'])){
            Produto::create($req); 
        }
        else{
            $acao='Editar';
            Produto::whereId( $req['id'] )->update($req); 
        } 
        $this->log->registrar($acao);
        return redirect('/produtos');
    }

    public function deletar($id)
    {
        if(!Auth::user()->temPermissao('del')){
            abort(503);
        }
        $this->log->registrar('Delete');
        Produto::where("id", "=", $id)->delete();
        return redirect('/produtos');
    }
}

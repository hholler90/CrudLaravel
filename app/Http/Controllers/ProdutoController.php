<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Providers\EventServiceProvider;
use Illuminate\Foundation\Auth\User;

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

        // dd($this->objUsuario->find(1)->load('perfil'));
        // dd(Usuario::with('perfil')->find(1));
        // dd($this->objUsuario->find(1)->perfil());
        // dd($this->objPerfil->find(1)->usuarios());
    }
    public function formulario($id)
    {
        return view('produto.formulario')->with(['formulario' =>Produto::find($id)]);
        
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
        $req['preco'] = trim($request->preco);
        $req['quantidade'] = trim($request->quantidade);
        if(empty($req['id'])){
            Produto::create($req); 
        }
        else{
            Produto::whereId( $req['id'] )->update($req); 
        } 
        return redirect()->route('produtos.index');
    }

    public function deletar($id)
    {
        Produto::where("id", "=", $id)->delete();
        return redirect()->route('produtos.index');
    }
}

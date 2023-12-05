<?php

// app/Http/Controllers/CarrinhoController.php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Support\Facades\Session;

class CarrinhoController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();

        return view('carrinho.index', compact('produtos'));
    }

    public function adicionarAoCarrinho($id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            flash('Message')->error();
            return redirect('/carrinho');
        }

        $carrinho = Session::get('carrinho', []);

        if (isset($carrinho[$produto->id])) {
            $carrinho[$produto->id]['quantidade']++;
        } else {
            $carrinho[$produto->id] = [
                'produto' => $produto,
                'quantidade' => 1,
            ];
            
        }
        flash('Produto adicionado ao carrinho')->success();
        Session::put('carrinho', $carrinho);

        return redirect('/carrinho');
    }

    public function verCarrinho()
    {
        $carrinhoItens = Session::get('carrinho', []);

        return view('carrinho.ver', compact('carrinhoItens'));
    }

    public function finalizarCompra()
    {
        Session::forget('carrinho');
        flash('Compra finalizada com sucesso!')->success();
        return redirect('/carrinho');
    }
}


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
            return redirect('/carrinho')->with('error', 'Produto não encontrado.');
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

        Session::put('carrinho', $carrinho);

        return redirect('/carrinho')->with('success', 'Produto adicionado ao carrinho com sucesso.');
    }

    public function verCarrinho()
    {
        $carrinhoItens = Session::get('carrinho', []);

        return view('carrinho.ver', compact('carrinhoItens'));
    }

    public function finalizarCompra()
    {
        Session::forget('carrinho');

        return redirect('/carrinho')->with('success', 'Compra finalizada com sucesso!');
    }
}


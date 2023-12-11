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
        $produtosDestaque = Produto::where('destaque', '>', 0)->inRandomOrder()->limit(3)->get();
        return view('carrinho.index', compact('produtos', 'produtosDestaque'));

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
    $carrinhoItens = Session::get('carrinho', []);

    foreach ($carrinhoItens as $item) {
        $produto = $item['produto'];
        $quantidade = $item['quantidade'];
        if ($produto->quantidade >= $quantidade) {
            $produto->decrement('quantidade', $quantidade);
        } else {
            flash('Produto sem estoque!')->success();
        }
    }
    Session::forget('carrinho');

    flash('Compra finalizada com sucesso!')->success();

    return redirect('/carrinho');
}

}


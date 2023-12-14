<?php

// app/Http/Controllers/CarrinhoController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Categoria;
use App\Models\CompraProduto;
use App\Models\Compra;
use Illuminate\Support\Facades\Session;


class CarrinhoController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        $categorias = Categoria::all();
        $produtos = Produto::all();
        $produtosDestaque = Produto::where('destaque', '>', 0)->inRandomOrder()->limit(3)->get();
        return view('carrinho.index', compact('produtos', 'produtosDestaque', 'categorias'));
    }

    public function adicionarAoCarrinho($id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            flash('Message')->error();
            return redirect('/carrinho');
        }

        $carrinho = Session::get('carrinho', []);

        if (!isset($carrinho['produtos'])) {
            $carrinho['produtos'] = [];
        }
        if (isset($carrinho['produtos'][$produto->id])) {
            $carrinho['produtos'][$produto->id]['quantidade']++;
        } else {
            $carrinho['produtos'][$produto->id] = [
                'produto' => $produto,
                'quantidade' => 1,
            ];
        }
        if (!isset($carrinho['valor_total'])) {
            $carrinho['valor_total'] = 0;
        }
        $carrinho['valor_total'] += $produto->preco;
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
        try {
            \DB::transaction(function (){
                $carrinhoItens = Session::get('carrinho', []);
                $compra = new Compra();
                $compra->registrar($carrinhoItens['valor_total']);

                foreach ($carrinhoItens['produtos'] as $item) {
                    $produto = $item['produto'];
                    $quantidade = $item['quantidade'];
                    $produtoQuantidade = Produto::find($produto->id);

                    if ($produtoQuantidade->quantidade >= $quantidade) {
                        $compraProduto = new CompraProduto();
                        $produtoCarrinho =  [
                            'produto_id' => $produto->id,
                            'valor_un' => $produto->preco,
                            'valor_total' => $produto->preco * $quantidade,
                            'quantidade' => $quantidade
                        ];

                        $produto->decrement('quantidade', $quantidade);
                        $compraProduto->registrar($compra->id, $produtoCarrinho);
                    } else {
                        throw new \Exception('Produto sem estoque!');
                    }
                }
                Session::forget('carrinho');

                flash('Compra finalizada com sucesso!')->success();
            });
        } catch (\Exception $e) {
            flash($e->getMessage())->error();
        }
        return redirect('/carrinho');
    }

    public function filtrarPorCategoria(Request $request)
    {
        $categoriaId = $request->input('categoria');

        if ($categoriaId == 0) {
            $produtos = Produto::all();
        } else {
            $produtos = Produto::where('categoria_id', $categoriaId)->get();
        }

        $categorias = Categoria::all();
        $produtosDestaque = Produto::where('destaque', '>', 0)->inRandomOrder()->limit(3)->get();

        return view('carrinho.index', compact('produtos', 'categorias', 'produtosDestaque'));
    }
}

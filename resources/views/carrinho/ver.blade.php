@extends('templates.template')
@section('content')

<div class="container">
    <h2>Carrinho de Compras</h2>

    @if(count($carrinhoItens) > 0)
    @php
    $totalCarrinho = 0;
    @endphp

    @foreach($carrinhoItens as $item)
    @php
    $totalItem = $item['quantidade'] * $item['produto']->preco;
    $totalCarrinho += $totalItem;
    @endphp

    <div class="media mb-4 container">
        <div style="display: flex;" class="ml-1">
            <img src="{{ asset($item['produto']->imagem) }}" class="mr-3" alt="{{ $item['produto']->nome }}" style="width: 170px;">
            <div style="margin-left: 100px;">
                <h5 class="mt-0">{{ $item['produto']->nome }}</h5>
                <p>Quantidade: {{ $item['quantidade'] }}</p>
                <p>Preço Unitário: R$ {{ number_format($item['produto']->preco, 2, ',', '.') }}</p>
                <p>Total: R$ {{ number_format($totalItem, 2, ',', '.') }}</p>
            </div>
        </div>
    </div>
    @endforeach
    <div class="text-right">
        <div class="text-right">
            <strong>Total: R$ {{ number_format($totalCarrinho, 2, ',', '.') }}</strong>
        </div>
        <div class="text-right mt-3">  
            <a href="{{ url('/carrinho') }}" class="btn btn-primary ml-2">Continuar Comprando</a>
            <a href="{{ url('/carrinho/finalizar') }}" class="btn btn-success">Finalizar Compra</a>
        </div>
    </div>
    @else
    <p>O carrinho está vazio.</p>
    @endif
</div>



@endsection
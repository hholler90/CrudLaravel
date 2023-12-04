@extends('templates.template')
@section('content')

    <div class="container">
        <h2>Carrinho de Compras</h2>
        
        @if(count($carrinhoItens) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Preço Unitário</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($carrinhoItens as $item)
                        <tr>
                            <td>{{ $item['produto']->nome }}</td>
                            <td>{{ $item['quantidade'] }}</td>
                            <td>R$ {{ number_format($item['produto']->preco, 2, ',', '.') }}</td>
                            <td>R$ {{ number_format($item['produto']->preco * $item['quantidade'], 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="text-right">
                
            </div>

            <div class="text-center mt-3">
                <a href="{{ url('/carrinho/finalizar') }}" class="btn btn-primary">Finalizar Compra</a>
                <a href="{{ url('/carrinho') }}" class="btn btn-primary">Continuar Comprando</a>
            </div>
        @else
            <p>O carrinho está vazio.</p>
        @endif
    </div>
@endsection
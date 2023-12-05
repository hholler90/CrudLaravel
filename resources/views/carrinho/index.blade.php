@extends('templates.template')
@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Produtos Disponíveis</div>
                <div class="card-body">
                    <a href="{{ url('carrinho/ver') }}" class="btn btn-sm btn-success">Ver Carrinho</a>
                    @if ($produtos->count() > 0)
                    <div class="row">
                        @foreach ($produtos as $produto)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                            <img src="{{ $produto->imagem }}" class="card-img-top" alt="{{ $produto->nome }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $produto->nome }}</h5>
                                    <p class="card-text">R$ {{ $produto->preco }}</p>
                                    <a href="{{ url('carrinho/adicionar/' . $produto->id) }}" class="btn btn-sm btn-success">Adicionar ao Carrinho</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-center">Nenhum produto disponível</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@extends('templates.template')
@section('content')
<div class="container">
    <h2>Destaques</h2>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach ($produtosDestaque as $index => $produto)
            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></li>
            @endforeach
        </ol>
        <div class="carousel-inner">
            @foreach ($produtosDestaque as $index => $produto)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <img class="d-block w-25 mx-auto" src="{{ $produto->imagem }}" alt="{{ $produto->nome }}">
                <div class="d-none d-md-block text-center ">
                    <h5>{{ $produto->nome }}</h5>
                    <p>R$ {{ $produto->preco }}</p>
                </div>
            </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span style="color:black" class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span style="color:black" class="sr-only">Próximo</span>
        </a>
    </div>
</div>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-3">
            <div class="container">
                <h2>Categorias</h2>
                <form action="{{ url('carrinho/filtrar') }}" method="get">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="{{ url('carrinho/filtrar?categoria=0') }}">Todas as Categorias</a>
                        </li>
                        @foreach ($categorias as $categoria)
                        <li class="list-group-item">
                            <a href="{{ url('carrinho/filtrar?categoria=' . $categoria->id) }}">{{ $categoria->nome }}</a>
                        </li>
                        @endforeach
                    </ul>
                </form>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Produtos Disponíveis</div>
                <div class="card-body">
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
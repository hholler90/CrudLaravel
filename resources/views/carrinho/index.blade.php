@extends('templates.template')
@section('content')
<<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Produtos Disponíveis</div>
                <div class="card-body">
                    <a href="{{ url('carrinho/ver') }}" class="btn btn-sm btn-success">Ver Carrinho</a>                 
                    @if ($produtos->count() > 0)
                        <ul class="list-group">
                            @foreach ($produtos as $produto)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $produto->nome }} - R$ {{ $produto->preco }}
                                    <span class="badge badge-primary badge-pill">R$ {{ $produto->preco }}</span>
                                    <a href="{{ url('carrinho/adicionar/' . $produto->id) }}" class="btn btn-sm btn-success">Adicionar ao Carrinho</a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-center">Nenhum produto disponível</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
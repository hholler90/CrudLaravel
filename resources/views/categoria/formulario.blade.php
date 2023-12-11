@extends('templates.template')

@section('content')
<div class="container">
    <h2>Categorias</h2>
    {!! Form::model($formulario,['url' => '/categorias', 'method' => 'post','id' => 'formCategoria']) !!}
    <div class="container">
        {{ Form::hidden('id') }}
        <div>
            <div class="row label">
                {{Form::label('nome','Nome de Categoria')}}

            </div>

        </div>
        <div id="pool">

            @if(!empty(old('categoria')))

            @foreach(old('categoria') as $i => $categoria)

            @include('categoria.campos',['i'=>$i])

            @endforeach
            @else

            @foreach($formulario->categoria as $i => $categoria)

            @include('categoria.campos',['i'=>$i])

            @endforeach
            @endif
        </div>
        <button type="reset" id="btnLimpar" class="btn btn-primary">Limpar</button>
        <input type="submit" class="btn btn-primary" value="Salvar" id="btnAdicionar">
    </div>
    <div class="">
        <span class="p-3 m-3">Últimas Categorias Cadastradas</span>
        <ul>
            <ul>
                @foreach($ultimasCategorias as $ultimaCategoria)
                <li>{{ $ultimaCategoria->nome }}</li>
                @endforeach
            </ul>
        </ul>
    </div>
    {!! Form::close() !!}
</div>
<template id="categoria">
    @include('categoria.campos',['i'=>'#INDICE#'])
</template>
<script>
    $(function() {

    })

    function remover(id) {
        $(`#pool #categoria_${id}`).remove()
    }

    function adicionar() {
        var id = parseInt($('#pool').children(':last').attr('id').split('_')[1]) + 1
        var html = $('#categoria').html().replaceAll('#INDICE#', id)
        $('#pool').append(html)
    }
</script>
@endsection
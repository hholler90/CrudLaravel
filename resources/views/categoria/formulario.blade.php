@extends('templates.template')

@section('content')
<div class="container">
    <h2>Categorias</h2>
    {!! Form::model($formulario,['url' => '/categorias', 'method' => 'post','id' => 'formCategoria']) !!}
    <div class="container">
        {{ Form::hidden('id') }}
        <div id="pool">
            <div>
                <div class="row label">
                    {{Form::label('nome','Nome de Categoria')}}
                    {{Form::text('nome',null,['class' => 'inputTamanho','placeholder' => 'Nome de Categoria','style' => 'width: 466px;'])}}
                </div>
                <span class="btn btn-primary" onclick="adicionar()">+++</span>
            </div>
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
    <div>
        <div class="row label">
            {{Form::label('nome','Nome de Categoria')}}
            {{Form::text('categoria[]',null,['class' => 'inputTamanho','placeholder' => 'Nome de Categoria','style' => 'width: 466px;'])}}
        </div>
        <span class="btn btn-primary" onclick="adicionar()">+++</span>
    </div>
</template>
<script>
    $(function() {

    })
    function adicionar() {
        var html = $('#categoria').html()
        $('#pool').append(html)
    }
</script>
@endsection
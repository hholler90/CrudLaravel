@extends('templates.template')

@section('content')

<link rel="stylesheet" href="/js/DataTables/datatables.css" />
<script src="/js/DataTables/datatables.js"></script>
<h1 class="text-center">Produtos</h1>
<div id="container">
  <div id="divtabela">

    <div class="col-8 m-auto">
      <table id="tabela" class="table text-center">
        <thead>
          <button type="button" class="btn btn-primary  " onclick="criar()">
            Cadastrar
          </button>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">Preco</th>
            <th scope="col">Quantidade</th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
        <tbody>
          @foreach($produtos as $produto)
          <tr>
            <th scope="row">{{$produto->id}}</th>
            <td>{{$produto->nome}}</td>
            <td>{{$produto->preco}}</td>
            <td>{{$produto->quantidade}}</td>
            <td>
              <a href="/produtos/deletar/{{$produto->id}}" class="btn btn-md btn-danger" title="Deletar">Deletar</a>
              <button type="button" class="btn btn-primary" onclick="editar({{$produto->id}})">Editar</button>
          </tr>
          @endforeach
    </div>
  </div>
  </tbody>
  </table>
</div>
</div>
@include('modal.create',['titulo' =>'Cadastrar Produto'])
<template id="formProduto">
  @include('produto.formulario')
</template>
{!!Html::script("js/jQuery.js")!!}
{!!Html::script("js/DataTables/language/pt-br.js")!!}
<script>
  $(function() {
    let table = new DataTable('#tabela', {
      "language": pt_br
    });
  })

  function criar() {
    $('#exampleModal').show()
    let html = $('#formProduto').html()
    $('#exampleModal #conteudo').empty().append(html)
  }

  function fechar() {
    $('#exampleModal #conteudo').empty()
    $('#exampleModal').hide()
  }

  function editar(id) {
    $.ajax({
        method: "GET",
        url: `/produtos/formulario/${id}`,
        type: 'json'
      })
      .done(function(html) {
        $('#exampleModal').show()
        $('#exampleModal #conteudo').empty().append(html)
      })
      .fail(function(error) {
        console.error(error)
      });
  }
</script>
@endsection
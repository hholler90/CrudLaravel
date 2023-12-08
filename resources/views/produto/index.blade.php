@extends('templates.template')

@section('content')

<link rel="stylesheet" href="/js/DataTables/datatables.css" />
<script src="/js/DataTables/datatables.js"></script>
<h1 class="text-center">Produtos</h1>
<div id="container" class="container">
  <div id="divtabela">

    <div class="col-8 m-auto">
      <table id="tabela" class="table text-center">
        <thead>
          @if (Auth::user()->temPermissao('add'))
          <button type="button" class="btn btn-primary " onclick="criar()">
            Cadastrar
          </button>
          @endif
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">Categoria</th>
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
            <td>{{$produto->categoria->nome}}</td>
            <td>{{$produto->preco}}</td>
            <td>{{$produto->quantidade}}</td>
            <td>
            @if (Auth::user()->temPermissao('del'))
            <button type="button" class="btn btn-md btn-danger" data-toggle="modal" data-target="#confirmDelete{{$produto->id}}">
                Deletar
              </button>
              <div class="modal fade" id="confirmDelete{{$produto->id}}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="confirmDeleteLabel">Confirmação de Exclusão</h5>
                      <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <label>Deseja mesmo deletar o produto {{$produto->nome}}?</label>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <form action="{{ route('produtos.deletar', ['id' => $produto->id]) }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-md btn-danger" title="Deletar">Deletar</button>
                      </form>
                      
                    </div>
                  </div>
                </div>
              </div>
              @endif
              @if (Auth::user()->temPermissao('edt'))
              <button type="button" class="btn btn-primary" onclick="editar({{$produto->id}})">Editar</button>
              @endif
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
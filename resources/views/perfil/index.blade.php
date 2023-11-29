@extends('templates.template')

@section('content')
<link rel="stylesheet" href="/js/DataTables/datatables.css" />
<script src="/js/DataTables/datatables.js"></script>
<h1 class="text-center">Perfis</h1>
<div id="container">

  </ul>
</div>
</nav>
<div id="divtabela">

  <div class="col-8 m-auto">
    <table id="tabela" class="table text-center">
      <button type="button" class="btn btn-primary " onclick="criar()">
        Cadastrar
      </button>
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nome Perfil</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach($perfis as $perfil)
        <tr>
          <th scope="row">{{$perfil->id}}</th>
          <td>{{$perfil->nome}}</td>
          <td>
            <a href="/perfis/deletar/{{$perfil->id}}" class="btn btn-md btn-danger" title="Deletar">Deletar</a>
            <button type="button" class="btn btn-primary" onclick="editar({{$perfil->id}})">Editar</button>
        </tr>
        @endforeach
  </div>
</div>
</tbody>
</table>
</div>
</div>
@include('modal.create',['titulo' =>'Cadastrar Perfil'])
<template id="formPerfil">
  @include('perfil.formulario')
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
    let html = $('#formPerfil').html()
    $('#exampleModal #conteudo').empty().append(html)
  }

  function fechar() {
    $('#exampleModal #conteudo').empty()
    $('#exampleModal').hide()
  }

  function editar(id) {
    $.ajax({
        method: "GET",
        url: `/perfis/formulario/${id}`,
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
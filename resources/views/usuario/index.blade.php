@extends('templates.template')

@section('content')
<link rel="stylesheet" href="/js/DataTables/datatables.css" />
<script src="/js/DataTables/datatables.js"></script>
<h1 class="text-center">Usuarios</h1>
<hr>
<div id="container">
  <div id="divtabela">

    <div class="col-8 m-auto">
      <table id="tabela" class="table text-center">
      @if (Auth::user()->temPermissao('add')) 
            <button type="button" class="btn btn-primary " onclick="criar()">
          Cadastrar
        </button>
      @endif        
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Tipo Perfil</th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
        <tbody>
          @foreach($usuarios as $usuario)
          <tr>
            <th scope="row">{{$usuario->id}}</th>
            <td>{{$usuario->nome}}</td>
            <td>{{$usuario->email}}</td>
            <td>{{$usuario->perfil->nome}}</td>
            <td>
            @if (Auth::user()->temPermissao('del')) 
              <a href="/usuarios/deletar/{{$usuario->id}}" class="btn btn-md btn-danger" title="Deletar">Deletar</a>
              @endif
              @if (Auth::user()->temPermissao('del'))
              <button type="button" class="btn btn-primary" onclick="editar({{$usuario->id}})">Editar</button>
              @endif
          </tr>
          @endforeach
          
    </div>
  </div>
  </tbody>
  </table>
</div>
</div>
@include('modal.create',['titulo' =>'Cadastrar Usuario'])
<template id="formUsuario">
  @include('usuario.formulario')
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
    let html = $('#formUsuario').html()
    $('#exampleModal #conteudo').empty().append(html)
  }

  function fechar() {
    $('#exampleModal #conteudo').empty()
    $('#exampleModal').hide()
  }

  function editar(id) {
    $.ajax({
        method: "GET",
        url: `/usuarios/formulario/${id}`,
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
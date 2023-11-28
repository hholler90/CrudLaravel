@extends('templates.template')

@section('content')
<link rel="stylesheet" href="/js/DataTables/datatables.css" />
<script src="/js/DataTables/datatables.js"></script>
<h1 class="text-center">Usuarios</h1>
<hr>
<div id="container">
  <nav class="navbar navbar-expand-lg navbar-light bg-light col-8 m-auto">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li>
        <button type="button" class="btn btn-primary " onclick="criar()">
          Cadastrar
        </button>
      </ul>
    </div>
  </nav>
<div id="divtabela">
  
  <div class="col-8 m-auto">
    <table id="tabela" class="table text-center">
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
            <a href="/usuarios/detetar/{{$usuario->id}}" class="btn btn-md btn-danger" title="Deletar">Deletar</a>
            <button type="button" class="btn btn-primary" onclick="editar({{$usuario->id}})">Editar</button>
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
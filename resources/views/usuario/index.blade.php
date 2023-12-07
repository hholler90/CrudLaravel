@extends('templates.template')

@section('content')
<link rel="stylesheet" href="/js/DataTables/datatables.css" />
<script src="/js/DataTables/datatables.js"></script>
<h1 class="text-center">Usuarios</h1>
<hr>
<div id="container" class="container">
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
              @if (Auth::user()->temPermissao('root'))
              <button type="button" class="btn btn-md btn-danger" data-toggle="modal" data-target="#confirmDelete{{$usuario->id}}">
                Deletar
              </button>
              <div class="modal fade" id="confirmDelete{{$usuario->id}}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="confirmDeleteLabel">Confirmação de Exclusão</h5>
                      <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <label>Deseja mesmo deletar o usuário {{$usuario->nome}}?</label>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <form action="{{ route('usuarios.deletar', ['id' => $usuario->id]) }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-md btn-danger" title="Deletar">Deletar</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              @endif
              @if (Auth::user()->temPermissao('edt'))
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
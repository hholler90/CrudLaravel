@extends('templates.template')

@section('content')
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 80%;
        margin: 20px auto;
    }

    h2 {
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    th,
    td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    thead {
        background-color: #f2f2f2;
    }

    tbody tr:hover {
        background-color: #f5f5f5;
    }

    /* Estilo para separar as tabelas */
    table+table {
        margin-top: 40px;
    }
</style>
@if (Auth::user()->temPermissao('del'))
<div class="container">
    <h2>Categorias</h2>
    <table id="tabela" class="table text-center">
        <thead>
            <a href="{{ url('categorias/formulario') }}" class="btn btn-primary text-right">Cadastrar</a>
            <tr>
                <th>ID</th>
                <th>Categoria</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach($categorias as $categoria)
            <tr>
                <td>{{ $categoria->id }}</td>
                <td>{{ $categoria->nome }}</td>
                <td>
                    @if (Auth::user()->temPermissao('del'))
                    <button type="button" class="btn btn-md btn-danger" data-toggle="modal" data-target="#confirmDelete{{$categoria->id}}">
                        Deletar
                    </button>
                    <div class="modal fade" id="confirmDelete{{$categoria->id}}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmDeleteLabel">Confirmação de Exclusão</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <label>Deseja mesmo deletar o produto {{$categoria->nome}}?</label>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <form action="{{ route('categoria.deletar', ['id' => $categoria->id]) }}" method="POST">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-md btn-danger" title="Deletar">Deletar</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if (Auth::user()->temPermissao('edt'))
                    <a href="{{ url('categorias/formulario', ['id' => $categoria->id]) }}" class="btn btn-primary text-right">Editar</a>
                    @endif
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    @endsection

    <script>

    </script>
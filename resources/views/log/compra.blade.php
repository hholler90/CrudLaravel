@extends('templates.template')

@section('content')
<div class="container">
    <link rel="stylesheet" href="{{ asset('js/DataTables/datatables.css') }}" />
    <script src="{{ asset('js/jQuery.js') }}"></script>
    <script src="{{ asset('js/DataTables/datatables.js') }}"></script>
    <script src="{{ asset('js/DataTables/language/pt-br.js') }}"></script>

    <h2>Compra Logs</h2>
    <table class="table" id="compraProdutoTable">
        <thead class="">
            <tr>
                <th>Data/Hora</th>
                <th>Produto</th>
                <th>Compra</th>
                <th>Valor Unitário</th>
                <th>Valor Total</th>
                <th>Quantidade</th>
            </tr>
        </thead>
        <tbody>
            @foreach($compraProduto as $log)
            <tr>
                <td>{{ $log->data_hora_formatada }}</td>
                <td>{{ $log->produto->nome }}</td>
                <td>{{ $log->compra->id }}</td>
                <td>{{ $log->valor_un }}</td>
                <td>{{ $log->valor_total }}</td>
                <td>{{ $log->quantidade }}</td>
                @endforeach
        </tbody>
    </table>
</div>
{!!Html::script("js/jQuery.js")!!}
{!!Html::script("js/DataTables/language/pt-br.js")!!}
<script>
    $(function() {
        let parametro = {
            "language": pt_br,
            "lengthMenu": [100, 250, 500, 750, 1000],
            "pageLength": 250,
            "searching": false
        }
        let tableCompraProduto = new DataTable('#compraProdutoTable', parametro);
    })
</script>

@endsection
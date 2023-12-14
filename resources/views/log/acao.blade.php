@extends('templates.template')

@section('content')
<div class="container">
    <link rel="stylesheet" href="{{ asset('js/DataTables/datatables.css') }}" />
    <script src="{{ asset('js/jQuery.js') }}"></script>
    <script src="{{ asset('js/DataTables/datatables.js') }}"></script>
    <script src="{{ asset('js/DataTables/language/pt-br.js') }}"></script>
    <h2>Ações Logs</h2>
    <table class="table" id="acaoLogsTable">
        <thead>
            <tr>
                <th>Usuario ID</th>
                <th>Ação</th>
                <th>Tela</th>
                <th>Timestamp</th>
                <th>Data hora</th>
            </tr>
        </thead>
        <tbody>
            @foreach($acaoLog as $log)
            <tr>
                <td>{{ $log->usuario_id }}</td>
                <td>{{ $log->acao }}</td>
                <td>{{ $log->tela }}</td>
                <td>{{ $log->created_at }}</td>
                <td>{{ $log->data_hora_formatada }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{!!Html::script("js/jQuery.js")!!}
{!!Html::script("js/DataTables/language/pt-br.js")!!}
<script>
    $(function() {
        let parametro={
            "language": pt_br,
             "lengthMenu" : [100, 250, 500, 750, 1000],
             "pageLength" : 250,
             "searching" : false
        }
        let tableAcao = new DataTable('#acaoLogsTable',  parametro);
    })
</script>

@endsection
@extends('templates.template')

@section('content')
<div class="container">
    <link rel="stylesheet" href="{{ asset('js/DataTables/datatables.css') }}" />
    <link rel="stylesheet" href="{{ asset('js/datepicker/jquery-ui.min.css') }}" />
    <script src="{{ asset('js/jQuery.js') }}"></script>
    <script src="{{ asset('js/DataTables/datatables.js') }}"></script>
    <script src="{{ asset('js/DataTables/language/pt-br.js') }}"></script>
    <script src="{{ asset('js/jMask/dist/jquery.mask.js') }}"></script>
    <script src="{{ asset('js/datepicker/jquery-ui.min.js') }}"></script>
    <h2>Compras Logs</h2>

    {!! Form::model($relatorio,['url' => '/relatorios/compra_filtro', 'method' => 'post']) !!}
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="row">
        <div class="col-md-3">
            <label for="dataInicial" class="form-label">Data Inicial:</label>
            {{Form::text('dataInicial',null,[ 'id'=>'dataInicial','class' => 'form-control','placeholder' => 'Selecione a Data Inicial'])}}
        </div>

        <div class="col-md-3">
            <label for="dataFinal" class="form-label">Data Final:</label>
            {{Form::text('dataFinal',null,[ 'id'=>'dataFinal' , 'class' => 'form-control','placeholder' => 'Selecione a Data Final'])}}
        </div>
        <div class="col-md-3">
            <label for="valorMinimo" class="form-label">Valor</label>
            {{Form::number('valorMinimo',null,[ 'id'=>'valorMinimo' , 'class' => 'form-control','placeholder' => 'Valor'])}}
        </div>
        <div class="col-md-12 mt-3 p-3">
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </div>
    </div>

    {!! Form::close() !!}
    <table class="table" id="compraLogs">
        <thead class="">
            <tr>
                <th>Usuario ID</th>
                <th>Data Hora</th>
                <th>Valor Total</th>
                <th>Opções</th>
            </tr>
        </thead>
        <tbody>
            @foreach($compraLogs as $log)
            <tr>
                <td>{{ $log->usuario->nome }}</td>
                <td>{{ $log->data_hora_formatada }}</td>
                <td>{{ $log->valor_total }}</td>
                <td><a  href="/relatorios/compraProduto/{{$log->id}}" class="btn btn-md btn-primary" >
                        Ver Detalhes
                    </a></td>
                @endforeach
        </tbody>
    </table>
</div>
<script type="text/javascript">
    $(function() {
        let parametro = {
            "language": pt_br,
            "lengthMenu": [100, 250, 500, 750, 1000],
            "pageLength": 250,
            "searching": false
        }
        let tableLogin = new DataTable('#compraLogs', parametro);

        $('#dataInicial,#dataFinal').mask('00/00/0000 00:00')
        $('#dataInicial').datepicker({
            dateFormat: `dd/mm/yy 00:00`,
            timeFormat: "hh:mm:ss",
            dayNames: ['Domingo', 'Segunda', 'Ter&ccedil;a', 'Quarta', 'Quinta', 'Sexta', 'S&aacute;bado'],
            dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
            dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'S&aacute;b'],
            monthNames: ['Janeiro', 'Fevereiro', 'Mar&ccedil;o', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']
        });
        $('#dataFinal').datepicker({
            dateFormat: `dd/mm/yy 23:59:59`,
            timeFormat: "hh:mm:ss",
            dayNames: ['Domingo', 'Segunda', 'Ter&ccedil;a', 'Quarta', 'Quinta', 'Sexta', 'S&aacute;bado'],
            dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
            dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'S&aacute;b'],
            monthNames: ['Janeiro', 'Fevereiro', 'Mar&ccedil;o', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']
        });
    })
</script>
@endsection
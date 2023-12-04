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

th, td {
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
table + table {
    margin-top: 40px;
}
</style>

    <h2>Login Logs</h2>
    <table>
        <thead>
            <tr>
                <th>Usuario ID</th>
                <th>Ação</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loginLogs as $log)
                <tr>
                    <td>{{ $log->usuario_id }}</td>
                    <td>{{ $log->acao }}</td>
                    <td>{{ $log->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Ações Logs</h2>
    <table>
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
                    <td>{{ $log->usuario_id}}</td>
                    <td>{{ $log->acao}}</td>
                    <td>{{ $log->tela}}</td>
                    <td>{{ $log->created_at }}</td>
                    <td>{{ $log->datahora }}</td>                   
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection


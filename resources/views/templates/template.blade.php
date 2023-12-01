<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funciona por favor!!!</title>
    {!!Html::style('css/style.css')!!}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> 
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light col-8 m-auto">
    <a class="navbar-brand" href="#">{{\Auth::user()->nome}}</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="/produtos">Produtos</a>
        </li>
        @if (Auth::user()->temPermissao('del'))
        <li class="nav-item">
          <a class="nav-link active" href="/usuarios">Usuarios</a>
        </li>
        @endif
        @if (Auth::user()->temPermissao('root'))
        <li class="nav-item">
          <a class="nav-link active" href="/perfis">Perfis</a>
        </li>
        @endif
        @if (Auth::user()->temPermissao('root'))
        <li class="nav-item">
          <a class="nav-link active" href="/log">Logs</a>
        </li>
        @endif
        <li class="nav-item">
          <a class="nav-link active " href="/logout">Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  @include('flash::message')
    @yield('content')
</body>

</html>
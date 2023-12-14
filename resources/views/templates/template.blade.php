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
    @if (!empty(Auth::user()))
    <a class="navbar-brand" href="#">{{Auth::user()->nome}}</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        @if (Auth::user()->temPermissao('add'))
        <li class="nav-item">
          <a class="nav-link active" href="/produtos">Produtos</a>
        </li>
        @endif
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
          <a class="nav-link active" href="/categorias">Categorias</a>
        </li>
        @endif

        <li class="nav-item text-right">
          <a class="nav-link active " href="/logout">Logout</a>
        </li>
        <li class="nav-item">
          @if (Auth::user()->temPermissao('root'))
          <div class="dropdown">
            <span class="dropdown-toggle nav-link active" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Relatorios
            </span>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="/relatorios/login">Login</a>
              <a class="dropdown-item" href="/relatorios/acao">Ação</a>
              <a class="dropdown-item" href="/relatorios/compra">Compra</a>
            </div>
          </div>
          @endif
      </ul>
    </div>
    @endif
    <span class="nav-item">
      <a class="nav-link  " href="/carrinho">Loja</a>
    </span>
    <span class="nav-item">
      <a class="nav-link" href="{{ url('/login') }}">Login</a>
    </span>
    <span class="nav-item">
      <a href="{{ url('carrinho/ver') }}" class="btn btn btn-primary">Ver Carrinho</a>
    </span>
  </nav>
  @include('flash::message')
  @yield('content')
</body>
</html>
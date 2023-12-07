
{!! Form::model($formulario,['url' => '/categoria', 'method' => 'post','id' => 'formCategoria']) !!}
<div class="container">
    {{ Form::hidden('id') }}
    <div class="row label">
        {{Form::label('nome','Nome de Categoria')}}
        {{Form::text('nome',null,['class' => 'inputTamanho','placeholder' => 'Nome de Categoria','style' => 'width: 466px;'])}}
    </div>
</div>
<div class="">
    <button type="reset" id="btnLimpar" class="btn btn-primary">Limpar</button>
    <input type="submit" class="btn btn-primary" value="Salvar" id="btnAdicionar">
</div>
{!! Form::close() !!}

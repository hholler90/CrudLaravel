{!! Form::model($formulario,['url' => '/produtos', 'method' => 'post','id' => 'formProduto', 'enctype' => 'multipart/form-data']) !!}
<div class="modal-body">
    {{ Form::hidden('id') }}
    <div class="row label">
        {{Form::label('nome','Nome de Produto')}}
        {{Form::text('nome',null,['class' => 'inputTamanho','placeholder' => 'Nome de Produto','style' => 'width: 466px;'])}}
    </div>
    <div class="row label">
        {{Form::label('preco','Preço')}}
        {{Form::number('preco',null,['class' => 'inputTamanho','placeholder' => 'Preço','style' => 'width: 466px;'])}}
    </div>
    <div class="row label">
        {{Form::label('quantidade','Quantidade')}}
        {{Form::number('quantidade',null,['class' => 'inputTamanho','placeholder' => 'Quantidade','style' => 'width: 466px;'])}}
    </div>
    <div class="row label">
        {{Form::label('categoria_id','Categoria')}}
        {{Form::select('categoria_id',$categorias,null,['class' => 'inputTamanho','style' => 'width: 466px;'])}}
    </div>
    <div class="row label">
        {{ Form::label('destaque', 'Destaque') }}
        {{ Form::select('destaque', ['0' => 'Padrão', '1' => 'Destaque'], null, ['class' => 'inputTamanho', 'style' => 'width: 466px;']) }}
    </div>
    <div class="row label">
        {{ Form::hidden('imagem') }}
        {{ Form::label('upload', 'Escolher Arquivo') }}
        {{ Form::file('upload', ['class' => 'inputTamanho']) }}
    </div>
</div>
<div class="modal-footer">
    <button type="reset" id="btnCancelar" class="btn btn-danger" onclick="fechar()">Cancelar</button>
    <button type="reset" id="btnLimpar" class="btn btn-primary">Limpar</button>
    <input type="submit" class="btn btn-primary" value="Salvar" id="btnAdicionar">
</div>
{!! Form::close() !!}
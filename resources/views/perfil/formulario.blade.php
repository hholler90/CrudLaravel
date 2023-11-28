{!! Form::model($formulario,['url' => '/perfis', 'method' => 'post','id' => 'formPerfil']) !!}
<div class="modal-body">
    {{ Form::hidden('id') }}
    <div class="row label">
        {{Form::label('nome','Nome de Perfil')}}
        {{Form::text('nome',null,['class' => 'inputTamanho','placeholder' => 'Nome de Perfil','style' => 'width: 466px;'])}}
    </div>
    @foreach ($permissoes as $id => $nome)
    <div class="form-check">
        {{ Form::checkbox('permissoes[]', $id, null, ['id' => 'permissao_' . $id, 'class' => 'form-check-input']) }}
        {{ Form::label('permissao_' . $id, $nome, ['class' => 'form-check-label']) }}
    </div>
    @endforeach
</div>
<div class="modal-footer">
    <button type="reset" id="btnCancelar" class="btn btn-danger" onclick="fechar()">Cancelar</button>
    <button type="reset" id="btnLimpar" class="btn btn-primary">Limpar</button>
    <input type="submit" class="btn btn-primary" value="Salvar" id="btnAdicionar">
</div>
{!! Form::close() !!}
{!! Form::model($formulario,['url' => '/perfis', 'method' => 'post','id' => 'formPerfil']) !!}
<div class="modal-body">
    {{ Form::hidden('id') }}
    <div class="row label">
        {{Form::label('nomeperfil','Nome de Perfil')}}
        {{Form::text('nomeperfil',null,['class' => 'inputTamanho','placeholder' => 'Nome de Perfil','style' => 'width: 466px;'])}}
    </div>
    @foreach ($permissoes as $id => $nome)
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="permissao_{{ $id }}" value="{{ $id }}" name="permissoes[]">
        <label class="form-check-label" for="permissao_{{ $id }}">{{ $nome }}</label>
    </div>
    @endforeach

</div>
<div class="modal-footer">
    <button type="reset" id="btnCancelar" class="btn btn-danger" onclick="fechar()">Cancelar</button>
    <button type="reset" id="btnLimpar" class="btn btn-primary">Limpar</button>
    <input type="submit" class="btn btn-primary" value="Salvar" id="btnAdicionar">
</div>
{!! Form::close() !!}
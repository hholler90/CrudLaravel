
{!! Form::model($formulario,['url' => '/usuarios', 'method' => 'post','id' => 'formUsuario']) !!}
    <div class="modal-body">
        {{ Form::hidden('id') }}
        <div class="row label">
            {{Form::label('nome','Nome de Usuário')}}
            {{Form::text('nome',null,['class' => 'inputTamanho','placeholder' => 'Nome de Usuário','style' => 'width: 466px;'])}}
        </div>
        <div class="row label">
            {{Form::label('email','Email')}}
            {{Form::email('email',null,['class' => 'inputTamanho','placeholder' => 'Email','style' => 'width: 466px;'])}}
        </div>
        <div class="row label">
            {{Form::label('password','Senha')}}
            {{Form::password('password',null,['class' => 'inputTamanho','placeholder' => 'Senha','style' => 'width: 466px;'])}}
        </div>
        <div class="row label">
            {{Form::label('perfil_id','Tipo de Usuário')}}
            {{Form::select('perfil_id',$perfis,null,['class' => 'inputTamanho','style' => 'width: 466px;'])}}
        </div>
    </div>
    <div class="modal-footer">
        <button type="reset" id="btnCancelar" class="btn btn-danger" onclick="fechar()">Cancelar</button>
        <button type="reset" id="btnLimpar" class="btn btn-primary">Limpar</button>
        <input type="submit" class="btn btn-primary" value="Salvar" id="btnAdicionar">
    </div>
{!! Form::close() !!}
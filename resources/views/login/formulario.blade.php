
{!! Form::model($formulario,['url' => '/login', 'method' => 'post','id' => 'formLogin']) !!}
    <h2 class="text-center">Faça seu Login</h2>
    <div class="form-group col-md-5 mx-auto">
    {{ Form::hidden('id') }}
        <div class="row label">
            {{Form::label('email','Email')}}
            {{Form::text('email',null,['class' => 'inputTamanho','placeholder' => 'Email','style' => 'width: 466px;'])}}
        </div>
        <div class="row label">
        {{Form::label('password',Senha')}}
        {{Form::text('password',null,['class' => 'inputTamanho','placeholder' => 'Senha','style' => 'width: 466px;'])}}
    </div>
        <div class="form-group col-md-5 mx-auto text-center">
            <input type="submit" class="btn btn-primary" value="Entrar">

        </div>
{!! Form::close() !!}

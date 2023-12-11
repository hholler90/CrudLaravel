
<div id="categoria_{{$i}}">
    <div class="row label">
        {{Form::text("categoria[$i]",null,['class' => 'inputTamanho','placeholder' => 'Nome de Categoria','style' => 'width: 466px;'])}}
    </div>
    @if (empty($id) && ($i === 0))
    <span class="btn btn-primary" onclick="adicionar()">+</span>
    @elseif(empty($id))
    <span class="btn btn-danger" onclick="remover({{$i}})">-</span>
    @endif
</div>
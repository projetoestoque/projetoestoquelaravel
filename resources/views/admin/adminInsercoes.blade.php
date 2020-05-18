@extends('template.site')

@section('titulo','Menu de Inserções')
@section('classBody','Background')
@section('conteudo')
<div class="butaoEspaco">
    <a href="{{ URL::route('admin.MenuCadastros') }}" class="waves-effect waves-teal btn-flat black-text">
    <i class="large material-icons">reply</i>
    <span class="ButtaoEspacoTexto"><b>Voltar</span>
    </a>
</div>
<br>
<br>
<br>
<div class="container ">
    <div class="row white text ">
        <a class="white-text" href="{{route('refeicao')}}">
            <div class=" card-panel blue accent-2 col s5 hoverable">
                <div class="row">
                    <span class="row"></span>
                        <div class="col">
                            <i class="material-icons medium white-text ">restaurant</i>
                            <h6 class="no-padding txt-md">Inserir Refeição</h6>
                        </div>
                    <span class="row"></span>
                </div>
            </div>
        </a>
        <div class="col s2"></div>
            <a href="{{route('entradaProduto')}}" class="white-text">
                <div class=" card-panel blue accent-2 col s5 hoverable">
                    <div class="row">
                    <span class="row"></span>
                        <div class="col ">
                            <i class="material-icons medium white-text pt-5">kitchen</i>
                            <h6>Inserir Produtos</h6>
                        </div>
                        <span class="row"></span>
                    </div>
                </div>
            </a>

    </div>  
</div>

</div>
@endsection
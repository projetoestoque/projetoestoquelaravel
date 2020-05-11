@extends('template.site')

@section('titulo','Menu de Cadastros')
@section('classBody','Background')
@section('conteudo')
<div class="butaoEspaco">
    <a href="{{ URL::route('home') }}" class="waves-effect waves-teal btn-flat black-text">
    <i class="large material-icons">reply</i>
    <span class="ButtaoEspacoTexto"><b>Voltar</span>
    </a>
</div>
<br>
<br>
<br>
<div class="container ">
<div class="row ">
<fieldset>
<legend><h4>Cadastros</h4></legend>
            <a href="{{route('produto')}}" class="white-text ">
                <div class=" card-panel blue accent-2 col s5 hoverablewhite-text ">
                    <div class="row">
                    <span class="row"></span>
                        <div class="col ">
                            <i class="material-icons medium white-text pt-5">free_breakfast</i>
                            <h6 class="no-padding txt-md">Cadastros de Produtos</h6>
                        </div>
                        <span class="row"></span>
                    </div>
                </div>
            </a>
            <div class="col s2">
            </div>
            <a href="{{route('doador')}}" class="white-text">
                <div class=" card-panel blue accent-2 col s5 hoverable">
                    <div class="row">
                    <span class="row"></span>
                        <div class="col ">
                            <i class="material-icons medium white-text pt-5">face</i>
                            <h6>Cadastros de Doadores</h6>
                        </div>
                        <span class="row"></span>
                    </div>
                </div>
            </a>
            <div class="col s1">
            </div>
</div>
</fieldset>
<fieldset>
  <legend><h4> Inserções</h4></legend>
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
            <a class="white-text" href="{{route('entradaProduto')}}">
                <div class=" card-panel blue accent-2 col s5 hoverable">
                    <div class="row">
                    <span class="row"></span>
                        <div class="col">
                            <i class="material-icons medium white-text ">kitchen</i>
                            <h6 class="no-padding txt-md">Inserir Produto</h6>
                        </div>
                        <span class="row"></span>
                        </div>
                </div>
            </a>
</div>
</fieldset>
<br>
<br>

@endsection
